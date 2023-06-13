<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'MENSAJE';

    protected $primaryKey = 'ID_mensaje';

    protected $fillable = [
        'ID_chat',
        'ID_usuario_emisor',
        'texto',
        'fecha',
    ];
    
    public $timestamps=false;
}
