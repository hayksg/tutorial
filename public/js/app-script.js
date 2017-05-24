$(function(){

    if ($(document).width() < 768) {
        $('.navbar-brand').show();
        $('.nav.navbar-nav li:first-child').remove();
    }

});