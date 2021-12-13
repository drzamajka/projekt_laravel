<?php

namespace App\Http\Controllers;

use App\Models\Gatunek;
use Illuminate\Http\Request;
use App\Http\Requests\Gatunki\GatunekRequest;
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

    public function create()
    {
        return view('gatunki.create');
    }

    public function store(GatunekRequest $request)
    {
        $gatunek = Gatunek::create(
            $request->all()
        );
        return redirect()->route('gatunki.index')
            ->with('success', __('translations.gatunki.flashes.success.stored', [
                'name' => $gatunek->nazwa_gatunku
            ]));
    }
}
