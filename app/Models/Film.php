<?php

namespace App\Models;

use App\Models\User;
use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravelista\Comments\Commentable;

class Film extends Model
{
    use HasFactory, SoftDeletes, Commentable;
    
    protected $table = 'film';
    protected $fillable = [
        'gatunek_id',
        'gwiazda_id',
        'tytul',
        'data_premiery',
        'opis',
        'users_id',
        'czyokladka',
    ];

    public function gatunek()
    {
        return $this->belongsTo(Gatunek::class);
    }

    public function gwiazda()
    {
        return $this->belongsTo(Gwiazda::class);
    }

    public function wlasciciel()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function gwiazdy_w_filmie()
    {
        return $this->belongsToMany(Gwiazda::class)
        ->orderBy('nazwisko_gwiazdy')
        ->withPivot('rola');
    }

    /**
     * Rozbudowanie zapytania o pozycje usunięte - local scope
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithInactive(Builder $query): Builder
    {
        return $query->withTrashed();
    }
}
