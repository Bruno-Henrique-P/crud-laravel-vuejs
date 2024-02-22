<?php

namespace App\Http\Controllers;


use App\Models\Vendedores;

class VendedorController extends Controller
{
    public function vendedor(){
        $vendedor= Vendedores::all();
        return response()->json(
           [
            'vendedor' => $vendedor,
            'message' => 'vendedores',
            'code' => 200
           ] 
        );
    }
    public function getVendedor($id){
        $vendedor = Vendedores::find($id);
        return response() ->json($vendedor);

    }
}
