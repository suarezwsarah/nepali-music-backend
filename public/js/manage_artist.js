"use strict";

$(function () {

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

    window.ArtistCrud = {
        create : function () {

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

        delete : function () {

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
        e.preventDefault();
        var form = $formAddArtist[0];
        var data = new FormData(form);
        data.append('artist_first_name', 'Sam');
        data.append('artist_last_name', 'Dahal');
        $.ajax({
            url : 'ajax_add_artist.php',
            data : data,
            type : 'POST',
            cache: false,
            processData: false,
            contentType: false,
            success : function (response, status) {
                var obj = JSON.parse(response);
                if (obj) {
                    $modalMessages.html(buildModalHtml(obj.msg, 'success'));
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
        $btnAddArtist.prop('disabled', false);
        $modalMessages.html('');
    });

});
