require('datatables.net-bs5');
require('./vendor/jsvalidation/js/jsvalidation');

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