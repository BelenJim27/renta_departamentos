<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    use HasFactory;
    protected $fillable = ['periodo', 'fecha_ini','fecha_fin','user_id','departamento_id'];


    public function departamento(){
        return $this->belongsTo(Departamento::class,'departamento_id');
    }

    public function rentas()
    {
        return $this->hasMany(Renta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

