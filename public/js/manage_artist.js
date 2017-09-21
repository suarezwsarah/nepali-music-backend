"use strict";

$(function () {

    var templateArtistTr = $('#templateArtistTr');
    var manageArtistTblBody = $('#manageArtistTblBody');

    var tblArtist = $('#tblArtist');
    var divManageArtistTbl = $('#divManageArtistTbl');

    var searArtistInputBox = $('#searchArtistInputBox');

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
                    .replace(/{{id}}/g, value.id);
            }
        });
        return listHtml;
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

});
