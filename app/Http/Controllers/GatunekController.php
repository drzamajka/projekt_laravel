<?php

namespace App\Http\Controllers;

use App\Models\Gatunek;
use Illuminate\Http\Request;

class GatunekController extends Controller
{
    public function index()
    {
        return view(
            'gatunki.index',
            [
                'gatunki' => Gatunek::withInactive()
                    ->withCount('filmy')
                    ->get()
            ]
        );
    }
}
