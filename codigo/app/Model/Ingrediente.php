<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $fillable = ['Nombre'];
    protected  $primaryKey = 'Nombre';
    public $timestamps = false;
    public $incrementing = false;

    public function platos(){
    	return $this->belongsToMany(Plato::class);
    }

    public function alergenos(){
    	return $this->belongsToMany(Alergeno::class);
    }
}
