<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'imagen', 'fecha', 'creador', 'img_creador', 'estado', 'url_proyecto'
    ];
}
