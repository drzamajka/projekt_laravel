<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use PhpParser\Builder\Property;

use Laravelista\Comments\Comment;
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
        $this->authorizeResource(Film::class, 'film');
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

    public function create(Request $request)
    {
        return view('filmy.create', [
            'director' => Gwiazda::find($request->old('gwiazda_id')),
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

    public function edit(Film $film, Request $request)
    {
        //dd(Film::with('gwiazdy_w_filmie','gwiazda')->find($film->id));
        $edit = true;
        return view('filmy.create', [
            'director' => Gwiazda::find($request->old('gwiazda_id')),
            'directors' =>  Gwiazda::orderBy('id')->get(),
            'types' => Gatunek::orderBy('nazwa_gatunku')->get(),
            'film' => Film::with('gwiazdy_w_filmie','gwiazda')->find($film->id),
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
        if ($request->hasFile('cover') || $film->czyokladka == 1)
            $aray = array_merge($request->all(), ['czyokladka' => '1']);
        else if($request->get("film-cover-check") === "false")
            $aray = array_merge($request->all(), ['czyokladka' => '0']);
   
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
        else{
            if($film->czyokladka == 1 && $aray["czyokladka"] == 0)
            {
                $destination = 'images/covers/'.$film->id.".jpg";
                if(File::exists($destination)){
                    File::delete($destination);
                }
            }
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
        $coments = Comment::onlyTrashed()->where('commentable_id', '=', $id)->where('deleted_at', '>=', $film->deleted_at);
        $coments->restore();
        $film->restore();
        return redirect()->route('home')
            ->with('success', __('translations.filmy.flashes.success.restore', [
                'name' => $film->tytul
            ]));
    }
}
