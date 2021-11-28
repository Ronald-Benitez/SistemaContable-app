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
        $idCostosMes = $this->comprobarMes(date('m'));
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
    public function show($mes)
    {
        $idCostosMes = $this->comprobarMes($mes);
        $Costos = DB::table('registro_costos')
            ->join('lista_costos', 'lista_costos.id', '=', 'registro_costos.LCostos_id')
            ->select('costoName','registro_costos.id','monto','type','LCostos_id')
            ->where('lista_costos.id',$idCostosMes)
            ->get();
            // $Costos= $Costos->groupBy('type');
            // $Costos->dd();
            // return $Costos;

        return view('Costos.index',compact('Costos'))->with('id',$idCostosMes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $registro = RegistroCosto::where('id', $id)->first();
        return view('Costos.edit',compact('registro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'costoName' => 'required',
            'monto' => 'required',
            'type' => 'required',
        ]);

        $registro = RegistroCosto::where('id', $id)->first();
        $cuentas=([
            'costoName'=>$request->costoName,
            'monto'=>$request->monto,
            'type'=> $request->type,
            'id'=>$request->id,
            'LCostos_id'=>$request->LCostos_id
        ]);
        $registro->update($cuentas);
        
        session()->put('alert', "success");
        session()->put('estado', "¡ Resitro de costo agregado !");
        
        return redirect()->route('Costos.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistroCosto  $cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $registro = RegistroCosto::where('id', $id)->first();
        $registro->delete();
        session()->put('alert', "danger");
        session()->put('estado', "¡ registro Eliminado con exito !");
        return redirect()->route('Costos.index');
    }

    public function comprobarMes($mes){
        $Costos = DB::table('lista_costos')
        ->whereMonth('created_at', $mes)
        ->first();

        if(empty($Costos)){
            $d=mktime(6, 1, 1, $mes,1, 2021);
            $LCostos = new ListaCostos();
            $LCostos->created_at = date("Y-m-d h:i:s", $d);
            $LCostos->save();
            $Costos = DB::table('lista_costos')
            ->whereMonth('created_at', date($mes))
            ->first();
            return $Costos->id;
        }
        return $Costos->id;
    }
    
}
