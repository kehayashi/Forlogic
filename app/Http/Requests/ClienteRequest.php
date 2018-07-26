<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'nome_cliente' => 'required',
            'nome_contato' => 'required',
            'data_cliente' => 'required'
        ];
    }

    public function messages(){
        return [
            'nome_cliente.required' => 'Preencha o campo NOME/RAZÃO SOCIAL',
            'nome_contato.required' => 'Preencha o campo NOME DO CONTATO',
            'data_cliente.required' => 'Preencha o campo DATA'
        ];
    }
}
