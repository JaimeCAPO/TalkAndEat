<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    use HasFactory;
    protected $table = 'PUBLICACION_PASO';

    protected $primaryKey = 'ID_paso';

    protected $fillable = [
        'ID_publicacion',
        'orden',
        'texto',
    ];
    
    public $timestamps=false;

}
