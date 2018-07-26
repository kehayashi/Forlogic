<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

	protected $table = 'clientes';

	protected $primaryKey = 'id_cliente';

	public $timestamps = false;

	protected $fillable = array('nome_cliente','nome_contato','data_cliente','categoria');
    
    public function avaliacao()
    {
		return $this->belongsToMany('App\Avaliacao', 'cliente_avaliacao', 'id_avaliacao', 'id_cliente')->withPivot('nota', 'motivo');
    }
    
}
