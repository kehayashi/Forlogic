<?php


Route::get('/', function () {
    return view('template_main');
});

Route::get('/form_cadastro_clientes', 'ClientesController@redirect_form_cadastro');

Route::post('/cadastrar_cliente', 'ClientesController@cadastrar_cliente');

Route::get('/form_cadastro_avaliacao', 'AvaliacaoController@redirect_form_avaliacao');

Route::post('/gerar_formulario', 'AvaliacaoController@gerar_form_avaliacao');

Route::post('/cadastrar_avaliacao', 'AvaliacaoController@cadastrar_avaliacao');

Route::get('/lista_avaliacoes', 'AvaliacaoController@lista_avaliacoes');

Route::get('/visualizar_avaliacao/{id}', 'AvaliacaoController@visualizar_avaliacao');

