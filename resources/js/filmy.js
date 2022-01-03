require('datatables.net-bs5');

$(function () {
    $('table').DataTable({
        ajax: {
            url: 'filmy/datatable',
            type: 'POST',
            // podczas wysyłania metodą POST koniecznie jest dodanie tokena
            // zabezpieczającego przed atakami CSRF
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'okladka', name: 'okladka', orderable: false, searchable: false },
            { data: 'gatunek.nazwa_gatunku', name: 'gatunek.nazwa_gatunku' },
            { data: 'rezyser', name: 'rezyser' },
            { data: 'tytul', name: 'tytul' },
            { data: 'data_premiery', name: 'data_premiery' },
            { data: 'gwiazdy_w_filmie[<br>].imie_gwiazdy', name: 'gwiazdy_w_filmie', orderable: false },
            { data: 'opis', name: 'opis' },
            { data: 'wlasciciel', name: 'wlasciciel' },
            { data: 'czyokladka', name: 'czyokladka' },
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
    $('#DataTables_Table_0 tbody').on('click', 'tr', function () {
        location.href = "filmy/"+this.getAttribute('id');
    });
});

