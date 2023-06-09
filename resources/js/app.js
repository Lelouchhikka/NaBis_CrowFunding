// Подключение jQuery
window.$ = window.jQuery = require('jquery');

// Подключение Bootstrap
require('bootstrap');

$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('show');
    });
});
