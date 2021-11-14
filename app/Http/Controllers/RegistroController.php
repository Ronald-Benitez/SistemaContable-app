<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            ->select('registros.partida', 'registros.created_at', 'cuentas.nombre', "registros.tipoM", "registros.monto")
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
        /*
        $request->validate([
            'idCuenta' => 'required|max:3',
            'monto' => 'required|gte:0',
            'tipo' => 'required|max:1'
        ]);*/

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

        return redirect()->route('Registro.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro $registro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro $registro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registro  $registro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro $registro)
    {
        //
    }
}
