<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index()
    {
        return view('home');
    }
    public  function  registrar(){

        return view ('pages/registrar');
    }

    public function storage (Request $request){

        $validator = Validator::make($request->all(),[
            'nick' => ['required', 'string','unique:users'],
            'nombre' => ['required', 'string'],
            'password' => ['required', 'string', 'min:2'],
            'rol' => ['required', 'string'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        //Validar rol
        $roles=['Admin','Operador','Administrativo'];
        foreach ($roles as $rol){
            if ($rol==$request->rol){
                $rol=true;
                break;
            }else{
                $rol=false;
            }
        }

        if ($rol==false){
            $mensaje = 'El rol no es admitido';
            return back()->with('mensaje', $mensaje);
        }
        if ($validator->fails()) {
            $errors = $validator->errors();
            $old = $request;
            return view('pages/registrar',compact('old','errors'));
        }
        $validaciones=['_'];
        $cont=1;
        for($i=65; $i<=90; $i++) {
            $letra = chr($i);
             $validaciones[$cont]=$letra;
             $cont=$cont+1;
        }
        $nik= Str::upper($request->nick);
        foreach ($validaciones as $validacion) {
            $value = Str::startsWith($nik, $validacion);
            if ($value==true){
                break;
            }
        }
        if ($value){
            //Si la validacion al inicio del nombre es correcta
            $user = new User();
            $user->Nick=$request->nick;
            $user->Nombre= $request->nombre;
            $user->	Apellidos=$request->apellidos;
            $user->Password=$request->password;
            $user->Rol=$request->rol;
            $user->Correo=$request->correo;
            $user->save();
            $mensaje = 'Datos guardados';
            return back()->with('mensaje', $mensaje);
        }else{
            $mensaje = 'El NICK no inicia con _ o con una letra';
            return back()->with('mensaje', $mensaje);
        }

    }
    public function edit($nick){
        $usuario = User::find($nick);

        return view ('pages/registrar', compact('usuario'));
    }
    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            'nick' => ['required', 'string'],
            'nombre' => ['required', 'string'],
            'password' => ['required', 'string', 'min:2'],
            'rol' => ['required', 'string'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $old = $request;
            return view('pages/registrar',compact('old','errors'));
        }
        dd("etr");
        $validaciones=['_'];
        $cont=1;
        for($i=65; $i<=90; $i++) {
            $letra = chr($i);
            $validaciones[$cont]=$letra;
            $cont=$cont+1;
        }
        $nik= Str::upper($request->nick);
        foreach ($validaciones as $validacion) {
            $value = Str::startsWith($nik, $validacion);
            if ($value==true){
                break;
            }
        }
        if ($value){
            //Si la validacion al inicio del nombre es correcta
            $usuarioUpdate = User::find($request->nick);
            $usuarioUpdate->Nick=$request->nick;
            $usuarioUpdate->Nick=$request->nick;
            $usuarioUpdate->Nombre= $request->nombre;
            $usuarioUpdate->	Apellidos=$request->apellidos;
            $usuarioUpdate->Password=$request->password;
            $usuarioUpdate->Rol=$request->rol;
            $usuarioUpdate->Correo=$request->correo;
            $usuarioUpdate->update();
            $mensaje = 'Datos Actualizados';
            return back()->with('mensaje', $mensaje);
        }else{
            $mensaje = 'El NICK no inicia con _ o con una letra';
            return back()->with('mensaje', $mensaje);
        }

    }
    public function destroy(Request $request,$nick){
        //dd($nick);
        $sql_delete = User::findOrFail($nick);
        $sql_delete->delete();
        $mensaje="Eliminado correctamente";

        $usuarios=User::all();
        return view('home', compact('usuarios','mensaje'));

    }
}



//$value = Str::startsWith('Esto es un texto de prueba', 'Esto');
