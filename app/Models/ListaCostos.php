<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaCostos extends Model
{
    use HasFactory;

    public function costos(){
        return $this->hasMany('App\Models\RegistroCosto');
    }
}
