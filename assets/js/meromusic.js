$(function () {

    $(document).ready(function () {
        var navs = $("#navBar li a");
        navs.click(function (event) {
            $("#navBar li").removeClass('active');
            $(event.target.parentNode.parentNode).addClass('active');
        });
    });


}());