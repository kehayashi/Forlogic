<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvaliacaoRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'mes' => 'required|not_in:null',
            'ano' => 'required|not_in:null',
            'clientes' => 'required|not_in:null'
        ];
    }

    public function messages(){
        return [
            'mes.required' => 'Preencha o campo MÊS',
            'ano' => 'Preencha o campo ANO',
            'clientes' => 'Selecione os clientes'
        ];
    }
}
