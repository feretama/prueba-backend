<?php

namespace App\Repositories;

use App\Models\Usuario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

use Exception;

use App\Traits\ApiResponses;

class UsuarioRepository{

    use ApiResponses;

    public function createUser($request){
        try {
            $user=$this->validarUsuario($request['mail']);
            if (isset($user)){
                return $this->errorResponse("Usuario ya existe",409);
            }
            $user= Usuario::create([
                'id_tipouser'=>2,
                'nombre'=>$request['nombre'],
                'mail'=>$request['mail'],
                'pass'=>Hash::make($request['pass'])
            ]);
            //return successResponseCreateUser and user created 201 code
        }catch(Exception $e){
            Log::info(["error al crear usuario"=>$e]);
            return $this->errorResponse("error al crear usuario",500);
        }
    }

    public function getUser($request){
        try {
            $user=$this->validarUsuario($request['mail']);
            if (isset($user)){
                return $user;
            }
            return $this->errorResponse("Usuario no encontrado",404);
        }catch(Exception $e){
            Log::info(["error al obtener usuario"=>$e]);
            return $this->errorResponse("error al obtener usuario",500);
        }
    }

    public function deleteUser($request){
        try{
            $user=$this->validarUsuario($request['mail']);
            if (isset($user)){
                $user->delete();
                //return successResponse
            }
            return $this->errorResponse("Usuario no encontrado",404);
        }catch(Exception $e){
            Log::info(["error al eliminar usuario"=>$e]);
            return $this->errorResponse("error al eliminar usuario",500);
        }
    }

    public function updateUser($request){
        try {
            $user=$this->validarUsuario($request['mail']);
            if (isset($user)){
                $user->mail=$request['mail'];
                $user->pass=Hash::make($request['pass']);
                $user->nombre=$request['nombre'];
                $user->save();
                return $this->successResponse($user,201);
            }
            return $this->errorResponse("Usuario no encontrado",404);
           
        }catch(Exception $e){
            Log::info(["error al crear usuario"=>$e]);
            return $this->errorResponse("error al crear usuario",500);
        }
    }

    public function validarUsuario($mail){
        try {
            $user=Usuario::where($mail)->first();
            if (isset($user)){
                return $user;
            }
        }catch(Exception $e){
            Log::info(["error al buscar usuario"=>$e]);
            throw new Exception ("error al buscar usuario",$e->getMessage());
        }
    }

    
}