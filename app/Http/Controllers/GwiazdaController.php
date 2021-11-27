<?php

namespace App\Http\Controllers;

use App\Models\Gwiazda;
use Illuminate\Http\Request;

class GwiazdaController extends Controller
{
    public function index()
    {
        return view(
            'gwiazdy.index',
            [
                'gwiazdy' => Gwiazda::withInactive()
                    ->withCount('filmy')
                    ->get()
            ]
        );
    }
}
