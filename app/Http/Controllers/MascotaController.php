<?php

namespace App\Http\Controllers;
use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MascotaController extends Controller
{
    //

    function test(Request $request){
        return response()->json(["error"=>false,"message"=>"Consulta Exitosa"],200);
    }
    function crearMascota(Request $request){
        DB::beginTransaction();
        $objetoMascota = new Mascota();
        try{
            if(!empty($request->id)){
                $objetoMascota=Mascota::find($request->id);
                $objetoMascota->raza = $request->raza;
                $objetoMascota->tamanio = $request->tamanio;
                $objetoMascota->save();
                DB::commit();
                return response()->json([
                    "error"=>false,
                    "message"=>"Registro actualizado",
                    "Detalles"=>$objetoMascota]
                    , 200);
            }else{
                $objetoMascota->raza = $request->raza;
                $objetoMascota->tamanio = $request->tamanio;
                $objetoMascota->save();
                DB::commit();
                return response()->json([
                    "error"=>false,
                    "message"=>"Registro Creado",
                    "Detalles"=>$objetoMascota]
                    , 201);
            }
        }catch(QueryException $queryException){
        DB::rollback();
        return response()->json($queryException->errorInfo,500);
        }
    }
       /*function crearMascota(Request $request){
        DB::beginTransaction();
        try{
        $objetoMascota = new Mascota();
        $objetoMascota->raza = $request->raza;
        $objetoMascota->tamanio= $request->tamanio;
        $objetoMascota->save();
        DB::commit();
        return response()->json(["error"=>false,"message"=>"Registro Creado","Detalles"=>$objetoMascota],201);
        }catch(QueryException $queryException){
        DB::rollback();
        return response()->json($queryException->errorInfo,500);
        }
    
    }*/

}