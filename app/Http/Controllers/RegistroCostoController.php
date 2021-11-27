<?php

namespace App\Http\Controllers;

use App\Models\RegistroCosto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListaCostos;

class RegistroCostoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        $idCostosMes = $this->comprobarMes();
        $Costos = DB::table('registro_costos')
            ->join('lista_costos', 'lista_costos.id', '=', 'registro_costos.LCostos_id')
            ->select('costoName','registro_costos.id','monto','type','LCostos_id')
            ->get();
            // $Costos= $Costos->groupBy('type');
            // $Costos->dd();
            // return $Costos;
            
        return view('Costos.index',compact('Costos'))->with('id',$idCostosMes);
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
        $request->validate([
            'costoName' => 'required',
            'monto' => 'required',
            'type' => 'required',
        ]);
        $registro = new RegistroCosto();
        $registro->costoName = $request->costoName;
        $registro->monto = $request->monto;
        $registro->type = $request->type;
        $registro->LCostos_id = $request->LCostos_id;
        
        $registro->save();
        session()->put('alert', "success");
        session()->put('estado', "¡ Resitro de costo agregado !");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuentas  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroCosto $cuentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroCosto $cuentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroCosto $cuentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroCosto $cuentas)
    {
        //
    }

    public function comprobarMes(){
        $Costos = DB::table('lista_costos')
        ->whereMonth('created_at', date('m'))
        ->first();

        if(empty($Costos)){
            $LCostos = new ListaCostos();
            $LCostos->save();
            $Costos = DB::table('lista_costos')
            ->whereMonth('created_at', date('m'))
            ->first();
        }
        return $Costos->id;
    }
    
}
