window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

window.bootstrap = require('bootstrap');

require('alpinejs');

// Komunikaty flash wyświetlane z użyciem toasts
var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function (toastEl) {
    // Stworzenie tablicy toasts z ewentualnymi opcjami
    return new bootstrap.Toast(toastEl)
});
// Pokazanie toasts
toastList.forEach(toast => toast.show());

// SweetAlert2
window.Swal = require('sweetalert2');

