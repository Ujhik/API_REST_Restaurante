<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CambiosPlatos extends Model
{
    protected $fillable = ['plato_Nombre', 'fecha_cambio', 'ingredientes_y_alergenos'];
    protected $dates = ['fecha_cambio'];
    public $timestamps = false;
    public $incrementing = false;


    public function plato(){
    	return $this->belongsTo(Plato::class);
    }
}
