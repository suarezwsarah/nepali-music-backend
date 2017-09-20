"use strict";

var manageCatTbl =  $('#manageCatTblBody');
var manageCatAjaxUrl = "ajax_manage_cat.php";

var loadAllCategories = function () {
    $.get(manageCatAjaxUrl, function (data, status) {
        if (data) {
            manageCatTbl.html("");
            $('#manageCatTblBody').html(data);
        } else {
            manageCatTbl.html("");
        }
    });
};

var updateCategory = function (id, elm) {
    $(document).ready(function () {
        var element = $(elm);
        //element.css("background","#FFF url(http://localhost/meromusic/public/images/giphy.gif) no-repeat right");
        $.ajax({
            url: "ajax_edit_cat.php",
            type: "POST",
            data: 'cat_id=' + id + '&category_name=' + elm.innerHTML,
            success: function (data) {
                //alert(data);
                element.removeAttr('background');
                element.css("background", "green");
            }
        });
    });
};

var onDocReady = function (params) {
  $(document).ready(function () {
      params.callback();
  });
};

var deleteCategory = function (id) {
    onDocReady({
        callback : function () {
            id = id.trim();
            $.ajax({
                url : 'ajax_delete_cat.php',
                type: 'POST',
                data: 'id=' + id,
                success : function (data, status) {
                    loadAllCategories();
                }
            });
        }
    });
};

(function () {
    $(document).ready(function () {

        var manageCatAjaxUrl = "ajax_manage_cat.php";

        loadAllCategories();


        $('#searchCatInputBox').keyup(function () {
            var searchKey = $(this).val().trim();
            if (searchKey.length > 0) {
                var urlToSearch = manageCatAjaxUrl + "?search_txt=" + searchKey;
                $.get(urlToSearch, function (data, status) {
                    console.log(status);
                    if (data) {
                        manageCatTbl.html("");
                        $('#manageCatTblBody').html(data);
                    } else {
                        manageCatTbl.html("");
                    }
                });
            } else {
                loadAllCategories();
            }
        });
        //data-toggle="modal" data-target="#addCategoryModal"
        $('#addCategoryLink').click(function (e) {
            e.preventDefault();
            $('#addCategoryModal').modal('toggle');
        });

        $('#btnAddCatModalSave').click(function () {
            var name = $('#category_name_1').val();
            var url = 'ajax_add_cat.php';
            $.ajax({
                url: url,
                type: 'POST',
                data: 'category_name_1='+name,
                success: function (data, status) {
                    //alert(data);
                    $('#addCategoryModal').modal('hide');
                    loadAllCategories();
                }
            });
        });

    });
}());