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

    });
}());