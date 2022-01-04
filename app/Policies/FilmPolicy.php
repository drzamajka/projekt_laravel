<?php

namespace App\Policies;

use App\Models\Film;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function film(User $user, Film $film)
    {
        dd($user);
        return true;
    }

    public function create(User $user)
    {
        return $user->can('filmy-store');
    }

    public function update(User $user, Film $film)
    {
        return $user->can('filmy-store') && $user->id === $film->users_id && $film->deleted_at === null;;
    }

    public function delete(User $user, Film $film)
    {
        return $user->can('filmy-store') && $user->id === $film->users_id && $film->deleted_at === null;
    }

    public function restore(User $user, Film $film)
    {
        return $user->can('filmy-store') && $user->id === $film->users_id && $film->deleted_at !== null;;
    }
}
