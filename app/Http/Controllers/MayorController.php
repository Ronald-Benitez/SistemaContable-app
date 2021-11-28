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

    public function show($mes)
    {
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->orderBy("cuentas.idC")
            ->get();

        if (empty($registros[0])) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return redirect()->route('mayor.index');
        }

        return view('mayor.index')->with('registros', $registros);
    }
}
