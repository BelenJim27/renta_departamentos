<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $fillable = ['imagen','disponibilidad', 'domicilio_id','descripcion','precio_renta'];

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class);
        return $this->hasOne(Domicilio::class,'id','domicilio_id');
    }

    public function renta()
    {
        return $this->hasOne(Renta::class);
    }
}
