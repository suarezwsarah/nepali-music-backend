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

(function () {
    $(document).ready(function () {

        var manageCatAjaxUrl = "ajax_manage_cat.php";
        var manageCatTbl =  $('#manageCatTblBody');

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

/*
        $('#manageCatTblBody tr td').blur(function () {
            alert('helol');
        });*/

    });
}());