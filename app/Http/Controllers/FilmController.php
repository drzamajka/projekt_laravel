<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use PhpParser\Builder\Property;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Filmy\FilmRequest;
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
        toast('wiadomość')->success();
        return $dataTable->render('filmy.index');
    }

    public function create()
    {
        return view('filmy.create', [
            'directors' =>  Gwiazda::orderBy('nazwisko_gwiazdy')->get(),
            'types' => Gatunek::orderBy('nazwa_gatunku')->get()
        ]);
    }

    public function store(FilmRequest $request)
    {    
        //dd($request->all());
        $aray;
        if ($request->hasFile('cover'))
            $aray = array_merge($request->all(), ['czyokladka' => '1']);
        else
            $aray = array_merge($request->all(), ['czyokladka' => '0']);

            $film = DB::transaction(function () use ($aray,$request) {
            $film = Film::create( $aray );
            $id = $request->input('aktorzy_id', []);
            $role = $request->input('aktorzy_role', []);
            //dd($role);
            for($i=0;$i<count($role);$i++)
                $film->gwiazdy_w_filmie()->attach($id[$i], [ 'rola' => $role[$i] ]);
            return $film;
        });

        
        if ($request->hasFile('cover')) {
            $image      = $request->file('cover');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(500, 720);
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/covers/'.$film->id.".jpg", $img, 'public');
        }
        return redirect()->route('filmy.index')
            ->with('success', __('translations.filmy.flashes.success.stored', [
                 'name' => $film->tytul
            ]));
    }
}
