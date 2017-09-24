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

    var categoryEditTr = $('.sd-category-editable');

    var templateModalError = $('#templateModalError');
    var modalErrors = $('#modalErrors');

    // input inside modal
    var fieldModalCategoryName = $('#category_name_1');

    window.CategoryCrud = {
        create : function (categoryName) {
            var url = 'ajax/ajax_add_cat.php';
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
            makeAjaxGetCall('ajax/ajax_manage_cat.php', function (response) {
                var obj = JSON.parse(response);
                if (obj.data) {
                    manageCatTblBody.html(buildTrHtml(obj.data));
                }
            })
        },

        update: function (id, elm) {
            divManageCatTbl.addClass('loading');
            tblCategory.addClass('no-display');
            $.ajax({
                url: "ajax/ajax_edit_cat.php",
                type: "POST",
                data: 'cat_id=' + id + '&category_name=' + elm.innerHTML,
                success: function (data, status) {
                    setTimeout(function () {
                        divManageCatTbl.removeClass('loading');
                        tblCategory.removeClass('no-display');
                    }, 500);
                }
            });
        },

        delete : function (id) {
            //divManageCatTbl.addClass('loading');
            //tblCategory.addClass('no-display');
            id = id.trim();
            $.ajax({
                url : 'ajax/ajax_delete_cat.php',
                type: 'POST',
                data: 'id=' + id,
                success : function (data, status) {
                    CategoryCrud.readAll();
                }
            });
        }
    }; // end CategoryCrud



    function buildTrHtml(items) {
        console.log(items);
        var myCustomeTr = $('#myCustomTr');
        var templateHtml = myCustomeTr.html();
        var listHtml = "";
        $.each(items, function(key, value) {
            if(value) {
                if (templateHtml) {
                    listHtml += templateHtml.replace(/{{name}}/g, value.name)
                        .replace(/{{id}}/g, value.id);
                }
            }
        });
        return listHtml;
    }

    // loading data on doc ready
    var manageCatAjaxUrl = "ajax_manage_cat.php";

    CategoryCrud.readAll();

    searchCatInputBox.keyup(function () {
        var searchKey = $(this).val().trim();
        if (searchKey.length > 0) {
            var urlToSearch = manageCatAjaxUrl + "?search_txt=" + searchKey;
            $.get(urlToSearch, function (response, status) {
                if (response) {
                    console.log(response);
                    var obj = JSON.parse(response);
                    var trHtml = buildTrHtml(obj.data);
                    manageCatTblBody.html("");
                    manageCatTblBody.html(trHtml);
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
        btnAddCatModalSave.prop('disabled', false);
        modalErrors.html('');
    });

    btnAddCatModalSave.click(function () {
        var name =fieldModalCategoryName.val();
        CategoryCrud.create(name);
    });

    var errorTemplate =  templateModalError.html();

    fieldModalCategoryName.keyup(function () {
        var currentVal = $(this).val();
        $.get('ajax/ajax_manage_cat.php?action=count&name='+currentVal, function (response, data) {
            var result = JSON.parse(response);
            if (result.row === "1") {
                console.log(result.row);
                btnAddCatModalSave.prop('disabled', 'disabled');
                var htmlError = errorTemplate.replace(/{{errorMessage}}/g, 'Category you entered already existed in the database');
                modalErrors.html(htmlError);
            } else {
                btnAddCatModalSave.removeAttr('disabled');
                $('#modalErrors').html('');
            }
        });
    });



});

function makeAjaxGetCall(url, callback) {
    $.get(url, function (data, status) {
        callback(data);
    })
}
