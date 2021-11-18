<?php

namespace App\Models;

use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'film';
    protected $fillable = [
        'id_gat',
        'id_rezyser',
        'tytul',
        'data_premiery',
        'opis',
    ];

    public function gatunek()
    {
        return $this->belongsTo(Gatunek::class);
    }

    public function gwiazda()
    {
        return $this->belongsTo(Gwiazda::class);
    }

    public function gwiazdy_w_filmie()
    {
        return $this->hasMany(Gwiazda::class)
        ->withPivot('rola');
    }
}
