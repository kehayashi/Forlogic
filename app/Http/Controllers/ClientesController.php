<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\Cliente;
use App\Http\Requests\ClienteRequest;
use DateTime;

Class ClientesController extends Controller {

  public function redirect_form_cadastro(){

    return view('form_cadastro_clientes');

  }//end redirect form_cadastro
  

  public function cadastrar_cliente(ClienteRequest $request){

    if(DB::table('Clientes')->where('nome_cliente', $request->nome_cliente)->count() == 0)
    {
        try
        {
            $cliente = new Cliente();
            $cliente->nome_cliente = $request->nome_cliente;
            $cliente->nome_contato = $request->nome_contato;
            $cliente->data_cliente = implode( '-', array_reverse( explode( '/', $request->data_cliente )));
            $cliente->categoria = 'nenhum';
            $cliente->save();

            $ok = 'true';
            return view('form_cadastro_clientes')->with('ok', $ok);
        }
        catch (Exception $e)
        {
            $ok = 'false';
            return view('form_cadastro_clientes')->with('ok', $ok);
        }
    }
    else
    {
        $cliente = DB::table('Clientes')->select('nome_cliente', 'categoria')->where('nome_cliente', $request->nome_cliente)->first();
        return view('form_cadastro_clientes')->with('cliente', $cliente);
    }
  }//end cadastrar_cliente

}

?>
