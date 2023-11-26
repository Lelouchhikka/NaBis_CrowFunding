// Подключение jQuery
window.$ = window.jQuery = require('jquery');

// Подключение Bootstrap
require('bootstrap');
import $ from 'jquery';
window.jQuery = $;
window.$ = $;
$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('show');
    });
});
