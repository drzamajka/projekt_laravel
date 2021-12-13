<?php

return [
    'dashboard' => [
        'title' => 'Projekt Laravel',
        'dashboard' => 'Kokpit',
        'home' => 'Strona główna',
        'disabled' => 'Wyłączone',
        'log-viewer' => 'Logi',
        'profile' => 'Profil',
        'settings' => 'Ustawienia',
        'log-out' => 'Wyloguj'
    ],
    'buttons' => [
        'cancel' => 'Anuluj',
        'store' => 'Dodaj',
        'update' => 'Aktualizuj',
        'yes' => 'Tak',
        'no' => 'Nie',
        'return' => 'Powrót',
        'store-star' => 'Dodaj gwiazde',
        'delete-star' => 'Usuń gwiazde'
    ],
    'gatunki' => [
        'title' => 'Gatunki',
        'labels' => [
            'create' => 'Dodanie nowej gatunek',
            'edit' => 'Edycja danych gatunku',
            'destroy' => 'Usunięcie gatunku',
            'destroy-question' => 'Czy na pewno usunąć gatunek :name?',
            'restore' => 'Anulowanie usunięcia gatunku',
            'restore-question' => 'Czy anulować usunięcie gatunku :name?'
        ],
        'attribute' => [
            'name' => 'nazwa gatunku',
            'count_filmy' => 'ilość filmów'
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano gatunek :name',
                'updated' => 'Zaktualizowano kategorię :name',
                'nothing-changed' => 'Dane kategorii :name nie zmieniły się',
                'destroy' => 'Kategoria :name została usunięty',
                'restore' => 'Usunięcie kategorii :name zostało anulowane'
            ]
        ]
    ],
    'gwiazdy' => [
        'title' => 'Gwiazdy',
        'labels' => [
            'create' => 'Dodanie nowej gwiazdy',
            'edit' => 'Edycja danych gatunku',
            'destroy' => 'Usunięcie gatunku',
            'destroy-question' => 'Czy na pewno usunąć gatunek :name?',
            'restore' => 'Anulowanie usunięcia gatunku',
            'restore-question' => 'Czy anulować usunięcie gatunku :name?'
        ],
        'attribute' => [
            'name' => 'Imie',
            'lastname' => 'Nazwisko',
            'count_filmy' => 'gra w filmach'
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano gwiazde :name :lastname',
                'updated' => 'Zaktualizowano kategorię :name',
                'nothing-changed' => 'Dane kategorii :name nie zmieniły się',
                'destroy' => 'Kategoria :name została usunięty',
                'restore' => 'Usunięcie kategorii :name zostało anulowane'
            ]
        ]
    ],
    'filmy' => [
        'title' => 'Filmy',
        'labels' => [
            'create' => 'Dodanie nowego filmu',
            'edit' => 'Edycja danych filmu',
            'destroy' => 'Usunięcie filmu',
            'destroy-question' => 'Czy na pewno usunąć filmu :name?',
            'restore' => 'Anulowanie usunięcia filmu',
            'restore-question' => 'Czy anulować usunięcie filmu :name?'
        ],
        'attribute' => [
            'type' => 'Gatunek',
            'director' => 'Reżyser',
            'title' => 'Tytół',
            'release' => 'Data premiery',
            'descryption' => 'Opis',
            'coverif' => 'Czy okładka',
            'cover' => 'Okładka',
            'stars' => 'Gwiazdy w Filmie',
            'star' => 'Gwiazda nr. :nr',
            'stars-as' => 'jako',
            'stars-empty' => 'Brak giazd na liscie',
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano film o tytule :name',
                'updated' => 'Zaktualizowano kategorię :name',
                'nothing-changed' => 'Dane kategorii :name nie zmieniły się',
                'destroy' => 'Kategoria :name została usunięty',
                'restore' => 'Usunięcie kategorii :name zostało anulowane'
            ]
        ]
    ],
    'attribute' => [
        'created_at' => 'utworzono',
        'updated_at' => 'zaktualizowano',
        'deleted_at' => 'usunięto',
    ],

];
