require('datatables.net-bs5');
require('./vendor/jsvalidation/js/jsvalidation');

const { registerConfirmAction } = require('./confirm_action');


$(function () {
    $('table').DataTable({
        ajax: {
            url: 'gwiazdy/datatable',
            type: 'POST',
            // podczas wysyłania metodą POST koniecznie jest dodanie tokena
            // zabezpieczającego przed atakami CSRF
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'imie_gwiazdy', name: 'imie_gwiazdy' },
            { data: 'nazwisko_gwiazdy', name: 'nazwisko_gwiazdy' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'deleted_at', name: 'deleted_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 }
        ],
        drawCallback: function (setting) {
            registerConfirmAction();
        },
        "language": {
            "url": "/vendor/datatables/i18n/" + config.locale + ".json"
        },
        processing: true,   // wyświetlanie komunikatu o przetwarzaniu
        serverSide: true,   // przetwarzanie po stronie serwera
        pageLength: 10,
        lengthMenu: [[10, 50, 100, 200], [10, 50, 100, 200]],
        stateSave: true,    //zapamiętuje stan ustawień
        stateDuration: 604800, //czas zapamiętywania ustawień w sekundach
    });
});

$('form[name=delete-item]').on('submit', function (e) {
    e.preventDefault();
    const data = $(e.currentTarget).data();
    const message = !_.isNil(data.message) ? data.message : 'NO_MESSAGE_PROVIDED';
    const icon = !_.isNil(data.icon) ? data.icon : 'warning';
    const confirmText = !_.isNil(data.confirmText) ? data.confirmText : 'Yes';
    const confirmClass = !_.isNil(data.confirmClass) ? data.confirmClass : '';
    const cancelText = !_.isNil(data.cancelText) ? data.cancelText : 'No';
    const cancelClass = !_.isNil(data.cancelClass) ? data.cancelClass : '';

    Swal.mixin({
        customClass: {
            confirmButton: confirmClass,
            cancelButton: cancelClass
        },
        buttonsStyling: false
    }).fire({
        text: message,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        focusCancel: true,
        icon: icon
    }).then((result) => {
        if (result.value) {
            this.submit()
        }
    });
});