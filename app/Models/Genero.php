<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    public $fillable = ['genero'];

    public function videojuegos(){
        return $this->belongsToMany(Videojuego::class)->withTimestamps();
    }
}
