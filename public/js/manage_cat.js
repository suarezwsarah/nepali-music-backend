"use strict";

$(function () {

    // Selectors
    var searchCatInputBox = $('#searchCatInputBox'); // input box search category
    var manageCatTblBody =  $('#manageCatTblBody'); // table body of manage category
    var addCategoryLink =  $('#addCategoryLink'); // anchor link for add category
    var btnAddCatModalSave =  $('#btnAddCatModalSave'); // save button inside modal for adding category
    var addCategoryModal =  $('#addCategoryModal'); // modal reference for adding category
    var tblCategory =  $('#tblCategory'); // table that holds everything for manage category including thead
    var divManageCatTbl =  $('#divManageCatTbl'); // this is the actual container for table

    // input inside modal
    var fieldModalCategoryName = $('#category_name_1');

    window.CategoryCrud = {
        create : function (categoryName) {
            var url = 'ajax_add_cat.php';
            $.ajax({
                url: url,
                type: 'POST',
                data: 'category_name_1='+categoryName,
                success: function (data, status) {
                    addCategoryModal.modal('hide');
                    CategoryCrud.readAll();
                }
            });
        },

        readAll : function () {
            manageCatTblBody.html("");
            makeAjaxGetCall('ajax_manage_cat.php', function (data) {
                manageCatTblBody.html(data);
            })
        },

        update: function (id, elm) {
            divManageCatTbl.addClass('loading');
            tblCategory.addClass('no-display');
            $.ajax({
                url: "ajax_edit_cat.php",
                type: "POST",
                data: 'cat_id=' + id + '&category_name=' + elm.innerHTML,
                success: function (data) {
                    setTimeout(function () {
                        divManageCatTbl.removeClass('loading');
                        tblCategory.removeClass('no-display');
                    }, 1000);
                }
            });
        },

        delete : function (id) {
            id = id.trim();
            $.ajax({
                url : 'ajax_delete_cat.php',
                type: 'POST',
                data: 'id=' + id,
                success : function (data, status) {
                    CategoryCrud.readAll();
                }
            });
        }
    }; // end CategoryCrud

    // loading data on doc ready
    var manageCatAjaxUrl = "ajax_manage_cat.php";

    CategoryCrud.readAll();

    searchCatInputBox.keyup(function () {
        var searchKey = $(this).val().trim();
        if (searchKey.length > 0) {
            var urlToSearch = manageCatAjaxUrl + "?search_txt=" + searchKey;
            $.get(urlToSearch, function (data, status) {
                if (data) {
                    manageCatTblBody.html("");
                    manageCatTblBody.html(data);
                } else {
                    manageCatTblBody.html("");
                }
            });
        } else {
            CategoryCrud.readAll();
        }
    });

    addCategoryLink.click(function (e) {
        e.preventDefault();
        addCategoryModal.modal('toggle');
    });

    // reset the modal when it is hidden
    addCategoryModal.on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    btnAddCatModalSave.click(function () {
        var name =fieldModalCategoryName.val();
        CategoryCrud.create(name);
    });


});

function makeAjaxGetCall(url, callback) {
    $.get(url, function (data, status) {
        callback(data);
    })
}
