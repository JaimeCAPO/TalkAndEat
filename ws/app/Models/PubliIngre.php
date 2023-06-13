<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubliIngre extends Model
{
    use HasFactory;
    protected $table = 'PUBLICACION_INGREDIENTE';
    protected $primaryKey = ['ID_publicacion', 'ID_ingrediente'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_publicacion',
        'ID_ingrediente',
        'unidad',
        'cantidad',
    ];
}
