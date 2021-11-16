<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Cuentas;
use Illuminate\Support\Facades\DB;
class MayorController extends Controller
{
    public function index()
    {
 
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto")
            ->whereMonth('created_at', date('m'))
            ->orderBy("cuentas.idC")
            ->get();
        return view('mayor.index')->with('registros', $registros);
        
       
    }
}
