<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Services\DataTables\FilmDataTable;

class FilmController extends Controller
{

    public function index(FilmDataTable $dataTable)
    {
        return $dataTable->render('filmy.index');
    }

    public function dataTable(FilmDataTable $dataTable)
    {
        return $dataTable->render('filmy.index');
    }
}
