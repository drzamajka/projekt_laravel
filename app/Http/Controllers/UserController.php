<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function uzytkownik(User $uzytkownik)
    {
        $this->authorize('uzytkownik', $uzytkownik);
        return view(
            'uzytkownik.index'
        )->with('uzytkownik',$uzytkownik);
    }

    public function nadajUprawnienia(User $uzytkownik)
    {
        $this->authorize('nadajUprawnienia', $uzytkownik);
        $creatorRole = Role::findByName(config('app.creator_role'));
        if (isset($creatorRole)) {
            $uzytkownik->assignRole($creatorRole);
        }
    
        return view(
            'uzytkownik.index'
        )->with('uzytkownik',$uzytkownik);
    }
}
