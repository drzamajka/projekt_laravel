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
        return null;
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

    public function edit(Gatunek $gatunek)
    {
        $edit = true;
        return view(
            'gatunki.create',
            compact('gatunek', 'edit')
        );
    }

    public function update(GatunekRequest $request, Gatunek $gatunek)
    {
        $gatunek->fill($request->all())->save();
        return redirect()->route('gatunki.index')
            ->with(
                'success',
                __(
                    $gatunek->wasChanged()
                        ? 'translations.gatunki.flashes.success.updated'
                        : 'translations.gatunki.flashes.success.nothing-changed',
                    [
                        'name' => $gatunek->nazwa_gatunku
                    ]
                )
            );
    }
}
