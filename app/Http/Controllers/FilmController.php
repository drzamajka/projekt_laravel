<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use PhpParser\Builder\Property;
use App\Services\DataTables\FilmDataTable;

class FilmController extends Controller
{

    public function index(FilmDataTable $dataTable)
    {
        return $dataTable->render('filmy.index');
    }

    public function film($id)
    {
        $film = Film::with('gatunek', 'gwiazda', 'gwiazdy_w_filmie')->find($id);
        //dd($film);
        return view(
            'filmy.film',
            [
                'gwiazdy' => 1
            ]
        )->with('film',$film);
    }

    public function dataTable(FilmDataTable $dataTable)
    {
        return $dataTable->render('filmy.index');
    }
}
