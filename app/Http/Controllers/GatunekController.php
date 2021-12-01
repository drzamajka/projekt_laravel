<?php

namespace App\Http\Controllers;

use App\Models\Gatunek;
use Illuminate\Http\Request;
use App\Services\DataTables\GatunekDataTable;

class GatunekController extends Controller
{

    public function index(GatunekDataTable $dataTable)
    {
        return $dataTable->render('gatunki.index');
    }

    public function dataTable(GatunekDataTable $dataTable)
    {
        return $dataTable->render('gatunki.index');
    }
}
