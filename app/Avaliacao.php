<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model {

	protected $table = 'avaliacao';

	protected $primaryKey = 'id_avaliacao';

	public $timestamps = false;

	protected $fillable = array('data_avaliacao');
	
	public function cliente()
	{
		return $this->belongsToMany('App\Cliente', 'cliente_avaliacao', 'id_avaliacao', 'id_cliente')->withPivot('nota', 'motivo');
	}
    
}