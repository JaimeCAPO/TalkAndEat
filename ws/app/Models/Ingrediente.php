<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;
    protected $table = 'INGREDIENTE';

    protected $primaryKey = 'ID_ingrediente';

    protected $fillable = [
        'nombre',
    ];
    
    public $timestamps=false;
}
