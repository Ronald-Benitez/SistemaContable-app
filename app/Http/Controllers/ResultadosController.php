<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ingresos($mes)
    {
        $ingresos = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select("registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->where('cuentas.tipoC', '=', '4')
            ->get();

        $ingreso = 0;
        if (!empty($ingresos[0])) {
            foreach ($ingresos as $data) {
                if ($data->tipoM == '2') {
                    $ingreso += $data->monto;
                } else {
                    $ingreso -= $data->monto;
                }
            }
        }
        return $ingreso;
    }

    public function costos($mes)
    {
        $costos = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select("registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->where('cuentas.tipoC', '=', '5')
            ->get();

        $costo = 0;
        if (!empty($costos[0])) {
            foreach ($costos as $data) {
                if ($data->tipoM == '2') {
                    $costo -= $data->monto;
                } else {
                    $costo += $data->monto;
                }
            }
        }
        // echo "<pre>";
        // var_dump($costos);
        // echo "</pre>";
        return $costo;
    }

    public function gastos($mes)
    {
        $gastos = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select("registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->where('cuentas.tipoC', '=', '6')
            ->get();

        $gasto = 0;
        if (!empty($gastos[0])) {
            foreach ($gastos as $data) {
                if ($data->tipoM == '2') {
                    $gasto -= $data->monto;
                } else {
                    $gasto += $data->monto;
                }
            }
        }
        // echo "<pre>";
        // var_dump($gastos);
        // echo "</pre>";
        return $gasto;
    }
    public function index()
    {
        $ingreso = $this->ingresos(date('m'));
        $costo = $this->costos(date('m'));
        $gasto = $this->gastos(date('m'));
        // echo $ingreso;
        // echo "<br>";
        // echo $costo;
        // echo "<br>";
        // echo $gasto;
        if ($ingreso == 0 && $costo == 0 && $gasto == 0) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return view('welcome');
        }
        return view('resultado.index', compact('ingreso', 'costo', 'gasto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingreso = $this->ingresos($id);
        $costo = $this->costos($id);
        $gasto = $this->gastos($id);
        // echo $ingreso;
        // echo "<br>";
        // echo $costo;
        // echo "<br>";
        // echo $gasto;
        if ($ingreso == 0 && $costo == 0 && $gasto == 0) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return redirect()->route('Resultados.index');
        }
        return view('resultado.index', compact('ingreso', 'costo', 'gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back();
    }
}
