<?php

namespace App\Http\Controllers;

use App\Models\Gwiazda;
use Illuminate\Http\Request;
use App\Http\Requests\gwiazdy\GwiazdaRequest;
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

    public function create()
    {
        return view('gwiazdy.create');
    }

    public function store(GwiazdaRequest $request)
    {
        $gwiazda = Gwiazda::create(
            $request->all()
        );
        return redirect()->route('gwiazdy.index')
            ->with('success', __('translations.gwiazdy.flashes.success.stored', [
                'name' => $gwiazda->imie_gwiazdy,
                'lastname' => $gwiazda->nazwisko_gwiazdy
            ]));
    }
}
