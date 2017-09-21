$(function () {

    $(document).ready(function () {

        // Select all navs anchor tag
        var navs = $("#navBar li a");
        navs.click(function (event) {
            // first remove all existing active css
            var url = $(this).data('url');
            console.log(urlText);
            event.preventDefault();
            $("#navBar li").removeClass('active');
            // add active css to currently clicked's parent's parent
            $(event.target.parentNode.parentNode).addClass('active');
            window.location.href = url;
        });

    });
}());