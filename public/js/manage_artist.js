"use strict";

$(function () {

    // initially set update artist to false
    // if we need to then we can set it to true
    var updateArtist = false;
    var $hiddenInputArtistId = $('#hiddenInputArtistId');

    var templateArtistTr = $('#templateArtistTr');
    var manageArtistTblBody = $('#manageArtistTblBody');

    var tblArtist = $('#tblArtist');
    var divManageArtistTbl = $('#divManageArtistTbl');

    var searArtistInputBox = $('#searchArtistInputBox');

    var $addEditArtistModal = $('#addEditArtistModal');
    var $linkAddArtist = $('#linkAddArtist');

    var $btnAddArtist = $('#btnAddCatModalSave');

    var $formAddArtist = $('#addArtistForm');

    var $modalMessages = $('#modalMessages');

    var templateModalMessages = $('#templateModalMessages');

    var $artistFileUploadInput = $('#artistFileUploadInput');

    var $inputArtistFirstName = $('#inputArtistFirstName');
    var $inputArtistLastName = $('#inputArtistLastName');
    var $imgArtistEditDisplay = $('#imgAristEditDisplay');

    $btnAddArtist.prop('disabled', true);

    $inputArtistFirstName.on('keyup', function () {
        var firstName = $(this).val().trim();
        var lastName = $inputArtistLastName.val().trim();
        if (firstName.length > 2 && lastName.length > 2) {
            $btnAddArtist.prop('disabled', false);
        } else {
            $btnAddArtist.prop('disabled', true);
        }
    });

    $inputArtistLastName.on('keyup', function () {
        var lastName = $(this).val().trim();
        var firstName = $inputArtistFirstName.val().trim();
        if (lastName.length > 2 && firstName.length > 2) {
            $btnAddArtist.prop('disabled', false);
        } else {
            $btnAddArtist.prop('disabled', true);
        }
    });

    window.ArtistCrud = {
        create : function () {

        },

        edit : function (id) {
            $.get('ajax_get_artist?id=' + id, function (response, status) {
                var obj = JSON.parse(response);
                $hiddenInputArtistId.val(id);
                $inputArtistFirstName.val(obj.data[0].first_name);
                $inputArtistLastName.val(obj.data[0].last_name);
                $imgArtistEditDisplay.attr('src', obj.data[0].img_url);
                updateArtist = true; // this is a request for updating the existing artist
                $addEditArtistModal.modal('toggle');
            });
        },

        readAll : function () {
            $.get('ajax_get_artist', function (response, status) {
                var obj = JSON.parse(response);
                var artists = obj.data;
                manageArtistTblBody.html(buildTrHtml(artists));
            });
        },

        update : function (id, elm) {
            divManageArtistTbl.addClass('loading');
            tblArtist.addClass('no-display');
            $.ajax({
                url: "ajax_edit_artist.php",
                type: "POST",
                data: 'artist_id=' + id + '&first_name=' + elm.innerHTML,
                success: function (data, status) {
                    setTimeout(function () {
                        divManageArtistTbl.removeClass('loading');
                        tblArtist.removeClass('no-display');
                        ArtistCrud.readAll();
                    }, 3000);
                }
            });
        },

        delete : function (id) {
            id = id.trim();
            $.ajax({
                url : 'ajax_delete_artist.php',
                type: 'POST',
                data: 'id=' + id,
                success : function (data, status) {
                    console.log(data);
                    ArtistCrud.readAll();
                }
            });
        }
    };

    function buildTrHtml(items) {
        var templateHtml = templateArtistTr.html();
        var listHtml = "";
        $.each(items, function(key, value) {
            if(value) {
                listHtml += templateHtml.replace(/{{firstName}}/g, value.first_name)
                    .replace(/{{lastName}}/g, value.last_name)
                    .replace(/{{imgUrl}}/g, value.img_url)
                    .replace(/{{id}}/g, value.id);
            }
        });
        return listHtml;
    }

    function buildModalHtml(msg, type) {
        var templateHtml = templateModalMessages.html();
        return templateHtml.replace(/{{msg}}/g, msg)
            .replace(/{{msgType}}/g, type);
    }


    ArtistCrud.readAll();

    searArtistInputBox.keyup(function () {
        var searchKey = $(this).val().trim();
        if (searchKey.length > 0) {
            var urlToSearch = "ajax_get_artist.php?search_txt=" + searchKey;
            $.get(urlToSearch, function (response, status) {
                console.log(response);
                if (response) {
                    var obj = JSON.parse(response);
                    var trHtml = buildTrHtml(obj.data);
                    manageArtistTblBody.html("");
                    manageArtistTblBody.html(trHtml);
                } else {
                    manageArtistTblBody.html("");
                }
            });
        } else {
            ArtistCrud.readAll();
        }
    });

    $linkAddArtist.click(function (e) {
        e.preventDefault();
        $addEditArtistModal.modal('toggle');
    });

    // When user selects the file
    // make a call to server to make sure file with
    // same name doesn't exist
    $artistFileUploadInput.on('change', function () {
        $modalMessages.html('');
        var fileName = $(this).val().split('\\').pop().replace(' ', '');
        $.ajax({
            url : 'ajax_add_artist.php?check_img=' + fileName,
            type : 'GET',
            success : function (data, status) {
                if (data) {
                    var obj = JSON.parse(data);
                    console.log(obj);
                    if (obj.exists) {
                        var modalHtml = buildModalHtml('The image already exists in server', 'danger');
                        $modalMessages.html(modalHtml);
                        $btnAddArtist.prop('disabled', true);
                    } else {
                        $btnAddArtist.prop('disabled', false);
                    }
                }
            }
        });
    });

    $btnAddArtist.on('click', function (e) {
        var url = updateArtist === true ? 'ajax_edit_artist.php' : 'ajax_add_artist';
        e.preventDefault();
        var form = $formAddArtist[0];
        var data = new FormData(form);
        data.append('artist_first_name', $inputArtistFirstName.val().trim());
        data.append('artist_last_name', $inputArtistLastName.val().trim());
        if (updateArtist) {
            data.append('artist_id', $hiddenInputArtistId.val().trim());
            $hiddenInputArtistId.val('');
        }
        $.ajax({
            url : url,
            data : data,
            type : 'POST',
            cache: false,
            processData: false,
            contentType: false,
            success : function (response, status) {
                var obj = JSON.parse(response);
                if (obj) {
                    $modalMessages.html(buildModalHtml(obj.msg, 'success'));
                    // reset the call once successfull if this case is update artist
                    if (updateArtist) {
                        updateArtist = false;
                    }
                    setTimeout(function () {
                        $addEditArtistModal.modal('hide');
                        ArtistCrud.readAll();
                    }, 2000)
                }
            }
        });
    });


    // reset the modal when it is hidden
    $addEditArtistModal.on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
        $btnAddArtist.prop('disabled', true);
        $modalMessages.html('');
        $imgArtistEditDisplay.attr('src', '');
    });

});
