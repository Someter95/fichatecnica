<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
    use HasFactory;
    public $fillable=[
        'nombre',
        'cargo',
        'unidad',
        'codigo',
        'modelo',
        'procesador',
        'memoriaram',
        'capacidadram',
        'discoduro',
        'capacidaddd',
        'tarjetavideo',
        'tarjetared',
        'tipomantenimiento',
        'observaciones',
        'fechaingreso',
        'fechasalida'
    ];

}
