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
            ->middleware(['permission:filmy-index']);  
    });

});

require __DIR__.'/auth.php';
