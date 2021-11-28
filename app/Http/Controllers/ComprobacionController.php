<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Cuentas;
use Illuminate\Support\Facades\DB;

class base
{
    public $nombre;
    public $saldo = 0;
    public $idC;
}

class ComprobacionController extends Controller
{
    public function verificar($arreglo, $dato)
    {
        foreach ($arreglo as $base) {
            $contador = 0;
            foreach ($base as $item) {

                if ($item->nombre == $dato) {
                    return $contador;
                }
                $contador++;
            }
        }
        return -1;
    }

    public function nombrar($index)
    {
        $nombres = array("Activo", "Pasivo", "Capital", "Ingresos", "Costos", "Gastos");
        return $nombres[$index - 1];
    }

    public function valor($registro)
    {
        if ($registro->tipoM == 1) {
            if ($registro->tipoC == "1" || $registro->tipoC == "5" || $registro->tipoC == "6") {
                return $registro->monto;
            } else {
                return 0 - $registro->monto;
            }
        } else {
            if ($registro->tipoC == "1" || $registro->tipoC == "5" || $registro->tipoC == "6") {
                return 0 - $registro->monto;
            } else {
                return $registro->monto;
            }
        }
    }

    public function generador($registros)
    {
        $count = 0;
        $datos = array(
            "Activo" => array(),
            "Pasivo" => array(),
            "Capital" => array(),
            "Ingresos" => array(),
            "Costos" => array(),
            "Gastos" => array()
        );
        foreach ($registros as $registro) {
            $exists = $this->verificar($datos, $registro->nombre);
            if ($exists > -1) {

                $datos[$this->nombrar($registro->tipoC)][$exists]->saldo += $this->valor($registro);
            } else {
                $nuevo = new base();
                $nuevo->nombre = $registro->nombre;
                $nuevo->saldo = $this->valor($registro);
                $nuevo->tipoC = $registro->tipoC;
                $nuevo->idC = $registro->idCuenta;
                array_push($datos[$this->nombrar($registro->tipoC)], $nuevo);
            }
        }
        return $datos;
    }

    public function index()
    {
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto", "cuentas.tipoC", "registros.idCuenta")
            ->whereMonth('created_at', date('m'))
            ->orderBy('cuentas.idC', "ASC")
            ->get();

        $datos = $this->generador($registros);

        return view('comprobacion.index')->with('datos', $datos);
    }

    public function show($mes)
    {
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto", "cuentas.tipoC", "registros.idCuenta")
            ->whereMonth('created_at', $mes)
            ->orderBy('cuentas.idC', "ASC")
            ->get();

        $datos = $this->generador($registros);

        if (empty($registros[0])) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return redirect()->route('Comprobacion.index');
        }

        return view('comprobacion.index')->with('datos', $datos);
    }
}
