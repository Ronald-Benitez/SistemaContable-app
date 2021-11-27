<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroCosto extends Model
{
    use HasFactory;

    protected $fillable = ['id','costoName','monto','type','LCostos_id'];
    
    //Relacion uno a muchos inversa
    public function ListaRegistro(){
       return $this->belongsTo('App\Models\ListaCostos'); 
    }
   
}
