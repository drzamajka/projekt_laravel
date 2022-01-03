<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GatunekController;
use App\Http\Controllers\GwiazdaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

 Route::get('/', [FilmController::class, 'index'] )->name('home');
 Route::name('filmy.')->prefix('filmy')->group(function () {
    Route::post('/datatable', [FilmController::class, 'dataTable'])
                ->name('datatable');
    Route::get('/film&{id}', [FilmController::class, 'film'])
                ->name('film');
    Route::get('{film}', [FilmController::class, 'film'])
        ->where('film', '[0-9]+')
        ->name('index');                
    Route::get('create', [GatunekController::class, 'create'])
            ->name('create')
            ->middleware(['permission:gatunki-store']);         
 });           
 //Route::get('/', function () { return view('dashboard'); } )->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::name('gatunki.')->prefix('gatunki')->group(function () {
        // lista wszystkich
        Route::get('', [GatunekController::class, 'index'])
            ->name('index')
            ->middleware(['permission:gatunki-index']);
        Route::post('/datatable', [GatunekController::class, 'dataTable'])
            ->name('datatable')
            ->middleware(['permission:gatunki-index']);
        // dodawanie wpisu   
        Route::get('create', [GatunekController::class, 'create'])
            ->name('create')
            ->middleware(['permission:gatunki-store']);  
        Route::post('', [GatunekController::class, 'store'])
            ->name('store')
            ->middleware(['permission:gatunki-store']);  
        // edycja wpisu
        Route::get('{gatunek}/edit', [GatunekController::class, 'edit'])
            ->where('gatunek', '[0-9]+')
            ->name('edit')
            ->middleware(['permission:gatunki-store']);
        Route::patch('{gatunek}', [GatunekController::class, 'update'])
            ->where('gatunek', '[0-9]+')
            ->name('update')
            ->middleware(['permission:gatunki-store']);      
    });

    Route::name('gwiazdy.')->prefix('gwiazdy')->group(function () {
        // lista wszystkich
        Route::get('', [GwiazdaController::class, 'index'])
            ->name('index')
            ->middleware(['permission:gwiazdy-index']);
        Route::post('/datatable', [GwiazdaController::class, 'dataTable'])
            ->name('datatable')
            ->middleware(['permission:gwiazdy-index']);
        // dodawanie wpisu   
        Route::get('create', [GwiazdaController::class, 'create'])
            ->name('create')
            ->middleware(['permission:gwiazdy-store']);  
        Route::post('', [GwiazdaController::class, 'store'])
            ->name('store')
            ->middleware(['permission:gwiazdy-store']);   
        // edycja wpisu
        Route::get('{gwiazda}/edit', [GwiazdaController::class, 'edit'])
            ->where('gwiazda', '[0-9]+')
            ->name('edit')
            ->middleware(['permission:gwiazdy-store']);
        Route::patch('{gwiazda}', [GwiazdaController::class, 'update'])
            ->where('gwiazda', '[0-9]+')
            ->name('update')
            ->middleware(['permission:gwiazdy-store']);     
    });

    Route::name('filmy.')->prefix('filmy')->group(function () {
        // lista wszystkich
        Route::get('', [FilmController::class, 'index'])
            ->name('index')
            ->middleware(['permission:filmy-index']);
        // dodawanie wpisu   
        Route::get('create', [FilmController::class, 'create'])
            ->name('create')
            ->middleware(['permission:filmy-index']);  
        Route::post('', [FilmController::class, 'store'])
            ->name('store')
            ->middleware(['permission:filmy-store']);  
        // edycja wpisu
        Route::get('{film}/edit', [FilmController::class, 'edit'])
            ->where('film', '[0-9]+')
            ->name('edit')
            ->middleware(['permission:filmy-store']);
        Route::patch('{film}', [FilmController::class, 'update'])
            ->where('film', '[0-9]+')
            ->name('update')
            ->middleware(['permission:filmy-store']);        
    });

});

require __DIR__.'/auth.php';
