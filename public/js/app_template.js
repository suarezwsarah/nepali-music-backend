"use strict";


$(function () {

    var categories = $('#linkCategories');
    var artists = $('#linkArtists');
    var container = $('#partialContent');

    // load dashboard page initially
    container.addClass('loading');
    $.get('dashboard.php', function (result) {
        setTimeout(function () {
            container.removeClass('loading');
            container.html(result);
        }, 3000);
    });

    categories.click(function (e) {
        container.html('');
        e.preventDefault();
        $("#navBar li").removeClass('active');
        // add active css to currently clicked's parent's parent
        $(event.target.parentNode.parentNode).addClass('active');
        container.addClass('loading');
        $.get('manage_cat.php', function (result) {
            setTimeout(function () {
                container.removeClass('loading');
                container.html(result);
            }, 3000);
        });
    });


    artists.click(function (e) {
        container.html('');
        e.preventDefault();
        $("#navBar li").removeClass('active');
        // add active css to currently clicked's parent's parent
        $(event.target.parentNode.parentNode).addClass('active');
        container.addClass('loading');
        $.get('manage_artist.php', function (result) {
            setTimeout(function () {
                container.removeClass('loading');
                container.html(result);
            }, 3000);
        });
    });



});