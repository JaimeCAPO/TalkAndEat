<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'LIKES';

    protected $primaryKey = ['ID_usuario','ID_publicacion'];

    protected $fillable = [
        'ID_usuario',
        'ID_publicacion',
    ];
    
    public $timestamps=false;
}
