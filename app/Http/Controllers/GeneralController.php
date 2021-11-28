<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class data
{
    public $nombre;
    public $saldo = 0;
    public $idC;
}

class GeneralController extends Controller
{
    public function verificar($arreglo, $dato)
    {
        foreach ($arreglo as $data) {
            $contador = 0;
            foreach ($data as $item) {

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
        $nombres = array("Activo", "Pasivo", "Capital");
        return $nombres[$index - 1];
    }

    public function valor($registro)
    {
        if ($registro->tipoM == 1) {
            if ($registro->tipoC == "1") {
                return $registro->monto;
            } else {
                return 0 - $registro->monto;
            }
        } else {
            if ($registro->tipoC == "1") {
                return 0 - $registro->monto;
            } else {
                return $registro->monto;
            }
        }
    }

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

    public function ajuste($mes)
    {
        $creditos = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select("registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->where('cuentas.idC', '=', '1.0.4')
            ->get();

        $debitos = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select("registros.tipoM", "registros.monto")
            ->whereMonth('created_at', $mes)
            ->where('cuentas.idC', '=', '2.0.6')
            ->get();

        $credito = 0;
        $debito = 0;

        if (!empty($creditos[0])) {
            foreach ($creditos as $data) {
                if ($data->tipoM == '2') {
                    $credito -= $data->monto;
                } else {
                    $credito += $data->monto;
                }
            }
        }

        if (!empty($debitos[0])) {
            foreach ($debitos as $data) {
                if ($data->tipoM == '1') {
                    $debito -= $data->monto;
                } else {
                    $debito += $data->monto;
                }
            }
        }

        return $credito - $debito;
    }

    public function generador($registros)
    {
        $count = 0;
        $datos = array(
            "Activo" => array(),
            "Pasivo" => array(),
            "Capital" => array(),
        );
        foreach ($registros as $registro) {
            $exists = $this->verificar($datos, $registro->nombre);
            if ($exists > -1) {

                $datos[$this->nombrar($registro->tipoC)][$exists]->saldo += $this->valor($registro);
            } else {
                $nuevo = new data();
                $nuevo->nombre = $registro->nombre;
                $nuevo->saldo = $this->valor($registro);
                $nuevo->tipoC = $registro->tipoC;
                $nuevo->idC = $registro->idCuenta;
                array_push($datos[$this->nombrar($registro->tipoC)], $nuevo);
            }
        }
        return $datos;
    }

    public function newData($nombre, $saldo, $tipo, $id)
    {
        $nuevo = new data();
        $nuevo->nombre = $nombre;
        $nuevo->saldo = $saldo;
        $nuevo->tipoC = $tipo;
        $nuevo->idC = $id;
        return $nuevo;
    }

    public function resultado($array, $ingresos, $costos, $gastos, $ajuste)
    {
        $suma = $ingresos - $costos - $gastos;
        $reserva = 0;
        $impuesto = 0;
        // echo $suma;
        // echo "<br>";

        if ($suma > 0) {
            $reserva += round($suma * 0.07, 2);
            $suma -= $reserva;
            // echo $suma;
            // echo "<br>";
        }

        if ($suma > 0) {
            if ($suma > 150000) {
                $impuesto += round($suma * 0.3, 2);
            } else {
                $impuesto += round($suma * 0.25, 2);
            }
            $suma -= $impuesto;
            // echo $suma;
            // echo "<br>";
        }

        if ($ajuste < 0) {
            $impuesto += $ajuste * -1;
        } else if ($ajuste > 0) {
            array_push($array['Activo'], $this->newData('Remanente de IVA', $ajuste, 1, '1.0.5'));
        }

        if ($reserva > 0) {
            array_push($array['Capital'], $this->newData('Reserva Legal', $reserva, 3, '3.0.4'));
        }

        if ($impuesto > 0) {
            array_push($array['Pasivo'], $this->newData('Impuestos por pagar', $impuesto, 2, '2.0.9'));
        }

        if ($suma > 0) {
            array_push($array['Capital'], $this->newData('Resultado del período', round($suma, 2), 3, '3.0.3'));
        }



        return $array;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingreso = $this->ingresos(date('m'));
        $costo = $this->costos(date('m'));
        $gasto = $this->gastos(date('m'));
        $ajuste = $this->ajuste(date('m'));

        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto", "cuentas.tipoC", "registros.idCuenta")
            ->whereMonth('created_at', date('m'))
            ->where('tipoC', '<', '4')
            ->where('cuentas.idC', 'not like', '1.0.4')
            ->where('cuentas.idC', 'not like', '2.0.6')
            ->orderBy('cuentas.idC', "ASC")
            ->get();

        $datos = $this->generador($registros);
        // echo $ingreso;
        // echo "<br>";
        // echo $costo;
        // echo "<br>";
        // echo $gasto;
        // echo "<br>";
        // echo $ajuste;
        // echo "<br>";
        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";

        $datos = $this->resultado($datos, $ingreso, $costo, $gasto, $ajuste);
        // echo "<br>";
        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";
        if (empty($registros[0])) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return view('welcome');
        }

        return view('general.index')->with('datos', $datos);
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
    public function show($mes)
    {
        $ingreso = $this->ingresos($mes);
        $costo = $this->costos($mes);
        $gasto = $this->gastos($mes);
        $ajuste = $this->ajuste($mes);

        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.partida', 'cuentas.nombre', "registros.tipoM", "registros.monto", "cuentas.tipoC", "registros.idCuenta")
            ->whereMonth('created_at', $mes)
            ->where('tipoC', '<', '4')
            ->where('cuentas.idC', 'not like', '1.0.4')
            ->where('cuentas.idC', 'not like', '2.0.6')
            ->orderBy('cuentas.idC', "ASC")
            ->get();

        $datos = $this->generador($registros);

        $datos = $this->resultado($datos, $ingreso, $costo, $gasto, $ajuste);

        if (empty($registros[0])) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return redirect()->route('General.index');
        }

        return view('general.index')->with('datos', $datos);
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
