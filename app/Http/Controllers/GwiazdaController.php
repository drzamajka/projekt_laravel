<?php

namespace App\Http\Controllers;

use App\Models\Gwiazda;
use Illuminate\Http\Request;
use App\Services\DataTables\GwiazdaDataTable;

class GwiazdaController extends Controller
{
    public function index(GwiazdaDataTable $dataTable)
    {
        return $dataTable->render('gwiazdy.index');
    }

    public function dataTable(GwiazdaDataTable $dataTable)
    {
        return $dataTable->render('gwiazdy.index');
    }
}
