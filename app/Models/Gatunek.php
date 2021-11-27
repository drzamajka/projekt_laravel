<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gatunek extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'gatunek';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nazwa_gatunku',
    ];


    public function filmy()
    {
        return $this->hasMany(Film::class);
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
