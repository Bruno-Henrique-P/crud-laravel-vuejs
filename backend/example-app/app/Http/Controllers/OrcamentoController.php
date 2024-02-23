<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Orcamento;
use App\Models\Vendedores;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function orcamento(){
        $orcamento = Orcamento::all();
        return response()->json(
           [
            'orcamentos' => $orcamento,
            'message' => 'orcamentos',
            'code' => 200
           ] 
        );
    }
    public function saveorcamento(Request $request) {
        $orcamento = new Orcamento();

        $cliente = Cliente::where('name',$request->cliente)->first();
        $vendedores = Vendedores::where('name',$request->vendedores)->first();
        
        echo $vendedores;

        if($cliente == null ){
            return response()-> json([
                "message" => "Cliente não encontrado",
                "code" => 400
            ]);
        }
        if($vendedores == null){
            return response()-> json([
                "message" => "Vendedor não encontrado",
                "code" => 400
            ]);
        }

        $orcamento->descricao = $request->descricao;

        $orcamento->cliente_id = $cliente->id;
        $orcamento->nameCliente = $cliente->name;
        $orcamento->vendedores_id = $vendedores->id;
        $orcamento->nameVendedor = $vendedores->name;

        $orcamento->valor = $request->valor;
        $orcamento->save();
        return response()-> json([
            "message" => "orcamento salvo",
            "code" => 200
        ]);
        
    }
    public function deleteorcamento($id){
        $orcamento = Orcamento::find($id);
        if($orcamento){
            $orcamento->delete();
            return response()->json([
                'message'=> 'orcamento Deleted Sucessfully',
                'code'=> 200
            ]);
        } else {
            return response()->json([
                'message'=> "orcamento with id:$id Not Found",
            ]);
        }
    }
    public function getcorcamento($id){
        $orcamento = Orcamento::find($id);
        return response()->json($orcamento);

    }
    public function updateorcamento($id, Request $request){
    
        $orcamento = Orcamento::where('id',$id)->first();
        $orcamento->descricao = $request->descricao;
        $orcamento->valor = $request->valor;

        $cliente = Cliente::where('name',$request->cliente)->first();
        $vendedores = Vendedores::where('name',$request->vendedores)->first();

        if( $vendedores == null){
            return response()-> json([
                "message" => "Vendedor nâo encontrado",
                "code" => 400
            ]);
        }
        if( $cliente == null){
            return response()-> json([
                "message" => "Cliente não encontrado",
                "code" => 400
            ]);
        }

        $orcamento->cliente_id = $cliente->id;
        $orcamento->nameCliente = $cliente->name;
        $orcamento->vendedores_id = $vendedores->id;
        $orcamento->nameVendedor = $vendedores->name;
       
        $orcamento->save();

        return response()-> json([
            "message" => "orcamento Alterado com sucesso",
            "code" => 200
        ]);

    }

    public function pesquisaOrcamento(Request $request){
        
        
        $orcamento = Orcamento::when($request->has('search'),function($whenQuerry) use ($request){
            $whenQuerry->where('id','LIKE',"{$request->search}")
                        ->orWhere('vendedores_id','LIKE',"%{$request->search}%")
                        ->orWhere('cliente_id','LIKE',"%{$request->search}%")
                        ->orWhere('nameCliente','LIKE',"%{$request->search}%")
                        ->orWhere('nameVendedor','LIKE',"%{$request->search}%");
            })
            ->when($request->filled("dataInit"),function($whenQuerry) use ($request){
                $whenQuerry->Where('created_at','>=',"{$request->dataInit} 00:00:00.00");
            })->when($request->filled("dataFim"),function($whenQuerry) use ($request){ 
                $whenQuerry->Where('created_at','<=',"{$request->dataFim} 23:00:00.00");
            })
            ->orderBy('id')
            ->paginate();

                                      
        return response()->json($orcamento);                
    }
    // public function getClientesName($orcamento) {
    //     $cliente = new ClienteController();
    //     $namesCliente = [];
    //     foreach($orcamento as $x){
    //         $nameCliente = $cliente->getcliente($x->cliente_id);
    //         array_push($namesCliente,$nameCliente);
    //     }
    //     return $namesCliente;
    // }
    // public function getVendedoresName($orcamento) {
    //     $vendedor = new VendedorController();
    //     $namesVendedor = [];
    //     foreach($orcamento as $x){
    //         $nameVendedor = $vendedor->getVendedor($x->vendedores_id);
    //         array_push($namesVendedor,$nameVendedor);
    //     }
    //     return $namesVendedor;
    // }
}
