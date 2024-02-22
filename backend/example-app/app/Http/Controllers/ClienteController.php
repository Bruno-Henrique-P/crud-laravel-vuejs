<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function cliente(){
        $clientes = Cliente::all();
        return response()->json(
           [
            'cliente' => $clientes,
            'message' => 'clientes',
            'code' => 200
           ] 
        );
    }
    public function savecliente(Request $resquest) {
        $cliente = new Cliente();
        $cliente->name = $resquest->name;
        $cliente->save();
        return response()-> json([
            "message" => "cliente salvo",
            "code" => 200
        ]);
        
    }
    public function deletecliente($id){
        $cliente = Cliente::find($id);
        if($cliente){
            $cliente->delete();
            return response()->json([
                'message'=> 'Contact Deleted Sucessfully',
                'code'=> 200
            ]);
        } else {
            return response()->json([
                'message'=> "Contact with id:$id Not Found",
            ]);
        }
    }
    public function getcliente($id){
        $cliente = Cliente::find($id);
        return response()->json($cliente);

    }
    public function updatecliente($id, Request $request){
        $cliente = Cliente::where('id',$id)->first();
        $cliente->name = $request->name;
        $cliente->save();
        return response()-> json([
            "message" => "cliente Alterado com sucesso",
            "code" => 200
        ]);

    }
}
