<?php

namespace App\Http\Controllers;

use App\Models\Gwiazda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\gwiazdy\GwiazdaRequest;
use App\Services\DataTables\GwiazdaDataTable;

class GwiazdaController extends Controller
{
    public function index(GwiazdaDataTable $dataTable)
    {
        return $dataTable->render('gwiazdy.index');
    }

    public function ajax(Request $request)
    {
        $search = $request->search;
        $directors = [];
        if (strlen($search) === 0) {
            $directors = Gwiazda::orderBy('nazwisko_gwiazdy', 'asc')
                ->select('id', 'imie_gwiazdy', 'nazwisko_gwiazdy')->limit(5)
                ->get()->toArray();
        } else {
            $directors = Gwiazda::orderBy('nazwisko_gwiazdy', 'asc')
            ->select('id', 'imie_gwiazdy', 'nazwisko_gwiazdy')
                ->where(DB::raw('CONCAT(imie_gwiazdy, " ", nazwisko_gwiazdy)'), 'like', '%' . $search . '%')
                ->get()->toArray();
        }
        // ->where("CONCAT(imie_gwiazdy,' ',nazwisko_gwiazdy)", 'like', '%' . $search . '%')
        return response()->json($directors);
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

    public function edit(Gwiazda $gwiazda )
    {
        $edit = true;
        return view(
            'gwiazdy.create',
            compact('gwiazda', 'edit')
        );
    }

    public function update(GwiazdaRequest $request, Gwiazda $gwiazda)
    {
        $gwiazda->fill($request->all())->save();
        return redirect()->route('gwiazdy.index')
            ->with(
                'success',
                __(
                    $gwiazda->wasChanged()
                        ? 'translations.gwiazdy.flashes.success.updated'
                        : 'translations.gwiazdy.flashes.success.nothing-changed',
                    [
                        'name' => $gwiazda->imie_gwiazdy.' '.$gwiazda->nazwisko_gwiazdy
                    ]
                )
            );
    }

    public function destroy(Gwiazda $gwiazda)
    {
        $gwiazda->delete();
        return redirect()->route('gwiazdy.index')
            ->with('success', __('translations.gwiazdy.flashes.success.destroy', [
                'name' => $gwiazda->imie_gwiazdy.' '. $gwiazda->nazwisko_gwiazdy
            ]));
    }

    public function restore(int $id)
    {
        $gwiazda = Gwiazda::onlyTrashed()->findOrFail($id);
        $gwiazda->restore();
        return redirect()->route('gwiazdy.index')
            ->with('success', __('translations.gwiazdy.flashes.success.restore', [
                'name' => $gwiazda->imie_gwiazdy.' '. $gwiazda->nazwisko_gwiazdy
            ]));
    }
}
