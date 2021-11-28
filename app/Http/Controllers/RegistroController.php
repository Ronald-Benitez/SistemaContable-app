<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Concepto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\session;
use DB;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->join('conceptos', 'conceptos.npartida', '=', "registros.partida")
            ->select('registros.partida', 'registros.created_at', 'cuentas.nombre', "registros.tipoM", "registros.monto", "conceptos.concepto")
            ->whereMonth('registros.created_at', date('m'))
            ->get();
        return view('registro.index')->with('registros', $registros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = \DB::table('cuentas')
            ->select('cuentas.idC', 'cuentas.nombre')
            ->orderby('id', 'ASC')
            ->get();

        $now = Carbon::now();

        return view('registro.form')->with('cuentas', $cuentas)->with('now', $now);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $partida =
            \DB::table('registros')
            ->select('partida')
            ->orderby('id', 'DESC')
            ->take(1)
            ->get();
        $cuentas = $_POST['idCuenta'];
        $montos = $_POST['monto'];
        $tipos = $_POST['tipoM'];

        for ($i = 0; $i < count($cuentas); $i++) {
            $registro = Registro::create([
                "partida" => $partida[0]->partida + 1,
                "monto" => $montos[$i],
                "tipoM" => $tipos[$i],
                "idCuenta" => $cuentas[$i],
            ]);
        }

        Concepto::create([
            "concepto" => $request->input("concepto"),
            "npartida" => $partida[0]->partida + 1
        ]);

        session_start();
        $_SESSION["estado"] = "Registro éxitoso";
        $_SESSION["alert"] = "success";
        return redirect()->route('Registro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show($registro)
    {
        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->join('conceptos', 'conceptos.npartida', '=', "registros.partida")
            ->select('registros.partida', 'registros.created_at', 'cuentas.nombre', "registros.tipoM", "registros.monto", "conceptos.concepto")
            ->whereMonth('registros.created_at', $registro)
            ->get();
        if (empty($registros[0])) {
            session_start();
            $_SESSION["estado"] = "Sin datos para mostrar";
            $_SESSION["alert"] = "warning";
            return redirect()->route('Registro.index');
        }
        return view('registro.index')->with('registros', $registros);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit($registro)
    {
        $cuentas = \DB::table('cuentas')
            ->select('cuentas.idC', 'cuentas.nombre')
            ->orderby('id', 'ASC')
            ->get();

        $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.idC', '=', 'registros.idCuenta')
            ->select('registros.id', 'registros.created_at', 'registros.partida', 'idC', 'cuentas.nombre', "registros.tipoM", "registros.monto")
            ->where('partida', $registro)
            ->get();

        $concepto = DB::table('conceptos')->where('npartida', $registro)->first();

        $now = Carbon::now();
        return view('registro.form')
            ->with('cuentas', $cuentas)
            ->with('now', $now)
            ->with("partida", $registro)
            ->with("registros", $registros)
            ->with("concepto", $concepto->concepto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $registro)
    {
        $ids = $_POST['id'];
        $cuentas = $_POST['idCuenta'];
        $montos = $_POST['monto'];
        $tipos = $_POST['tipoM'];



        for ($i = 0; $i < count($cuentas); $i++) {
            $data = array(
                "monto" => $montos[$i],
                "tipoM" => $tipos[$i],
                "idCuenta" => $cuentas[$i],
            );
            $rUpdate = Registro::where('id', $ids[$i]);
            $rUpdate->update($data);
        }

        $concepto = Concepto::where('npartida', $registro);
        $concepto->update([
            'concepto' => $request->input('concepto')
        ]);

        session_start();
        $_SESSION["estado"] = "Actualización éxitosa";
        $_SESSION["alert"] = "success";
        return redirect()->route('Registro.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy($registro)
    {
        DB::table('registros')
            ->where('partida', $registro)
            ->delete();
        session_start();
        $_SESSION["estado"] = "Eliminado éxitoso";
        $_SESSION["alert"] = "danger";
        return redirect()->route('Registro.index');
    }
}
