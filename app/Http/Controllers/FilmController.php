<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use PhpParser\Builder\Property;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Filmy\FilmRequest;
use App\Services\DataTables\FilmDataTable;

class FilmController extends Controller
{

    public function __construct()
    {
        // Autoryzacia
        $this->authorizeResource(film::class, 'film');
    }

    public function index(FilmDataTable $dataTable)
    {
        return $dataTable->render('filmy.index');
    }

    public function film($id)
    {
        $film = Film::withTrashed()->with('gatunek', 'gwiazda', 'wlasciciel', 'gwiazdy_w_filmie')->find($id);
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
        $aray;
        if ($request->hasFile('cover'))
            $aray = array_merge($request->all(), ['czyokladka' => '1']);
        else
            $aray = array_merge($request->all(), ['czyokladka' => '0']);
        $aray = array_merge($aray, ['users_id' => Auth::user()->id]);    
        //dd($aray);
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
        return redirect()->route('home')
            ->with('success', __('translations.filmy.flashes.success.stored', [
                 'name' => $film->tytul
            ]));
    }

    public function edit(Film $film )
    {
        $edit = true;
        return view('filmy.create', [
            'directors' =>  Gwiazda::orderBy('nazwisko_gwiazdy')->get(),
            'types' => Gatunek::orderBy('nazwa_gatunku')->get(),
            'film' => Film::with('gwiazdy_w_filmie')->find($film->id),
            'edit' => true
        ]);
        return view(
            'filmy.create',
            compact('film', 'edit')
        );
    }

    public function update(FilmRequest $request, Film $film)
    {
        $aray;
        if ($request->hasFile('cover'))
            $aray = array_merge($request->all(), ['czyokladka' => '1']);
        else
            $aray = $request->all();
        if ($request->hasFile('cover')) {
            $destination = 'public/covers/'.$film->id.".jpg";
            if(File::exists($destination)){
                File::delete($destination);
            }
            $image      = $request->file('cover');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(500, 720);
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/covers/'.$film->id.".jpg", $img, 'public');
        }    
        
        $film = DB::transaction(function () use ($aray,$request,$film) {
            $film->fill($aray)->save();
            $id = $request->input('aktorzy_id', []);
            $role = $request->input('aktorzy_role', []);
            $film->gwiazdy_w_filmie()->detach();
            for($i=0;$i<count($role);$i++)
                $film->gwiazdy_w_filmie()->attach($id[$i], [ 'rola' => $role[$i] ]);
            return $film;
        });

        return redirect()->route('home')
            ->with(
                'success',
                __( 'translations.filmy.flashes.success.updated', [ 'name' => $film->tytul])
            );
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('home')
            ->with('success', __('translations.filmy.flashes.success.destroy', [
                'name' => $film->tytul
            ]));
    }

    public function restore(int $id)
    {
        $film = Film::onlyTrashed()->findOrFail($id);
        $film->restore();
        return redirect()->route('home')
            ->with('success', __('translations.filmy.flashes.success.restore', [
                'name' => $film->tytul
            ]));
    }
}
