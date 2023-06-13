<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'PUBLICACION';

    protected $primaryKey = 'ID_publicacion';

    protected $fillable = [
        'ID_usuario',
        'titulo',
        'descripcion',
        'imagen',
        'duracion',
        'dificultad',
    ];
    
    public $timestamps=false;
}
