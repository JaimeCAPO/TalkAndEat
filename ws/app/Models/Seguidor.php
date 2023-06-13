<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{
    use HasFactory;
    protected $table = 'SEGUIDOR';

    protected $primaryKey = ['ID_usuario_seguidor','ID_usuario_seguido'];

    protected $fillable = [
        'ID_usuario_seguidor',
        'ID_usuario_seguido',
        'estado',
    ];
    
    public $timestamps=false;

}
