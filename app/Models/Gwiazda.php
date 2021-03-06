<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Gwiazda extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'gwiazda';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'imie_gwiazdy',
        'nazwisko_gwiazdy',
    ];

    public function filmy()
    {
        return $this->hasMany(Film::class);
    }

    public function gwiazdy_w_filmie()
    {
        return $this->hasMany(Film::class)
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
