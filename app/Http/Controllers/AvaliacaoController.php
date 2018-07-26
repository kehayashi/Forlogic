<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cliente;
use App\Avaliacao;
use App\Http\Requests\AvaliacaoRequest;
use DateTime;
use Response;

Class AvaliacaoController extends Controller {

  public function redirect_form_avaliacao(){
    date_default_timezone_set('America/Sao_Paulo');

    $date = date('Y-m-d');

    $limite = ((DB::table('Clientes')->count() * 20) / 100);

    $ultimaAvaliacao = DB::table('avaliacao')->latest('id_avaliacao')->first();

    if($ultimaAvaliacao != null)
    {
      $clientes = DB::select
          ("SELECT * FROM `Clientes` 
              WHERE data_ultima_avaliacao is null 
                OR TIMESTAMPDIFF(MONTH, Clientes.data_ultima_avaliacao, '$date') > 3"
          );

      $de = \Carbon\Carbon::createFromFormat('Y-m-d', $ultimaAvaliacao->data_avaliacao);
      $ate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);

      $dif_mes = $de->diffInMonths($ate);

      if($dif_mes > 0)
      {
        return view('form_cadastro_avaliacao')->with('clientes', $clientes)->with('limite', $limite);
      }
      if($dif_mes == 0)
      {
      return view('aviso');
      }
    }
    else
    { 
      $clientes = Cliente::all(); 
      return view('form_cadastro_avaliacao')->with('clientes', $clientes)->with('limite', $limite);
    }

  }//end redirect form_avaliacao


  public function gerar_form_avaliacao(AvaliacaoRequest $request){

    $clientes = collect();

    for ($i=0; $i < count($request->clientes); $i++)
    {
        $obj = DB::table('Clientes')->select('id_cliente', 'nome_cliente')->where('id_cliente', $request->clientes[$i])->get();
        $clientes->push($obj);
    }

    return view('form_cadastro_avaliacao_2')->with('clientes', $clientes)->with('ano', $request->ano)->with('mes', $request->mes) ;

  }//end gerar_form_avaliacao

  
  public function cadastrar_avaliacao(Request $request){
    date_default_timezone_set('America/Sao_Paulo');

    $date = date('Y-m-d');

    DB::beginTransaction();

    try
    {
      $avaliacao = new Avaliacao();
      $avaliacao->data_avaliacao = $request->input('ano').'-'.$request->input('mes').'-'.'01';
      $avaliacao->save();

      for($i=0; $i<count($request->clientes); $i++)
      {
        $cliente = Cliente::find($request->clientes[$i]);
        if($request->notas[$i] >= 0 && $request->notas[$i] <= 6)
        {
          $cliente->categoria = 'Detrator';
        }
        if($request->notas[$i] >=7 && $request->notas[$i] <= 8)
        {
          $cliente->categoria = 'Neutro';
        }
        if($request->notas[$i] >= 9 && $request->notas[$i] <= 10)
        {
          $cliente->categoria = 'Promotor';
        }

        $cliente->data_ultima_avaliacao = $request->input('ano').'-'.$request->input('mes').'-'.'01';;
        $cliente->save();

        $avaliacao->cliente()->attach($avaliacao->id_avaliacao,
          array(
            'id_cliente' => $request->clientes[$i], 
            'nota' => $request->notas[$i], 
            'motivo' => $request->motivos[$i]
          )
        );
      } // end for

      DB::commit();

      $de = \Carbon\Carbon::createFromFormat('Y-m-d', $avaliacao->data_avaliacao);
      $ate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
  
      $dif_mes = $de->diffInMonths($ate);

      if($dif_mes == 0)
      {
        return view('aviso');
      }
      else
      {
        $ok = 'true';
        return view('form_cadastro_clientes')->with('ok', $ok);
      }

    } //end try
    catch (Exception $e)
    {
        $ok = 'false';
        return view('form_cadastro_clientes')->with('ok', $ok);
    }
    
  }//end cadastrar avaliacao


  public function lista_avaliacoes(){

    $avaliacoes = Avaliacao::all();

    //dd($avaliacoes);

    return view('lista_avaliacoes')->with('avaliacoes', $avaliacoes);

  }//end lista_avaliacoes


  public function visualizar_avaliacao($id){

    $avaliacao = Avaliacao::find($id);

    $nPromotores = DB::table('Clientes')
             ->join('cliente_avaliacao', 'Clientes.id_cliente', '=', 'cliente_avaliacao.id_cliente')
             ->join('avaliacao', 'cliente_avaliacao.id_avaliacao', '=', 'avaliacao.id_avaliacao')
             ->where('avaliacao.data_avaliacao', '=', $avaliacao->data_avaliacao)
             ->where('clientes.categoria', '=', 'promotor')
             ->count();

    $nDetratores = DB::table('Clientes')
             ->join('cliente_avaliacao', 'Clientes.id_cliente', '=', 'cliente_avaliacao.id_cliente')
             ->join('avaliacao', 'cliente_avaliacao.id_avaliacao', '=', 'avaliacao.id_avaliacao')
             ->where('avaliacao.data_avaliacao', '=', $avaliacao->data_avaliacao)
             ->where('clientes.categoria', '=', 'detrator')
             ->count();

    $nClientes = DB::table('Clientes')
             ->join('cliente_avaliacao', 'Clientes.id_cliente', '=', 'cliente_avaliacao.id_cliente')
             ->join('avaliacao', 'cliente_avaliacao.id_avaliacao', '=', 'avaliacao.id_avaliacao')
             ->where('avaliacao.data_avaliacao', '=', $avaliacao->data_avaliacao)
             ->count();

    $dadosAvaliacao = DB::select
        ("SELECT c.id_cliente, c.nome_cliente, ca.nota, ca.motivo, a.data_avaliacao 
            FROM Clientes c, cliente_avaliacao ca, avaliacao a 
              WHERE c.id_cliente = ca.id_cliente 
                AND ca.id_avaliacao = a.id_avaliacao 
                  AND a.id_avaliacao = '$avaliacao->id_avaliacao';
        ");

    $NPS = ((($nPromotores) - ($nDetratores)) / 4) * 100;

    return view('info_avaliacao')->with('nPromotores', $nPromotores)
                                 ->with('nDetratores', $nDetratores)
                                 ->with('nClientes', $nClientes)
                                 ->with('avaliacao', $avaliacao)
                                 ->with('dadosAvaliacao', $dadosAvaliacao)
                                 ->with('NPS', $NPS);

  }//end visualizar_avaliacoes 
}

?>
