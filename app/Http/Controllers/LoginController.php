<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }
    public function loguear(Request $request){//INICIO DE SESION DEL USUARIO
        
        $request->validate([//VALIDACION DE INFORMACION REQUERIDA
            'username'=>'required|alpha_dash',
            'password'=>'required'
        ]);
        $usuario = Usuario::where('username','=',$request->username)->first();
        //USUSARIO NO ENCONTRADO
        if(empty($usuario)){
            $request->session()->put('alert', "danger");
            $request->session()->put('estado', "El usuario ".$request->username." no existe");
            return view('login.index');
        }
        //COMPROVACION DEL MISMO USERNAME
        if($usuario->username == $request->username){
            //COMPROVACION DE LA CONTRASEÑA
            if (password_verify($request->password,$usuario->password)){
                $request->session()->put([
                    'idUser'=>$usuario->id,
                    'username'=> $usuario->username,
                    'typeUser'=> $usuario->type,
                    'alert'=>"primary",
                    'estado'=>"¡ Bienvenido ".$usuario->username." !"
                ]);
                return redirect()->route('Welcome.index');
            }else{//ERROR EN CONTRASEÑA
                $request->session()->put('alert', "danger");
                $request->session()->put('estado', "Contraseña incorrecta");
                return view('login.index');
            
            }
        }else{//COMPROVACION DE USUARIO EXISTENTE
            $request->session()->put('alert', "danger");
            $request->session()->put('estado', "El usuario ".$request->username." no existe");
            return view('login.index');
        }
    }
    public function logout(){//CIERRE DE SESION DEL USUARIO
        session()->flush();
        session()->put('alert', 'success');
        session()->put('estado', '¡ Gracias por visitarnos !');  
        return redirect()->route('Welcome.index');

    }
}
