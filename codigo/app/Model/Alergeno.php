<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alergeno extends Model
{
    protected $fillable = ['Nombre'];
    protected  $primaryKey = 'Nombre';
    public $timestamps = false;
    public $incrementing = false;

    public function ingredientes(){
    	return $this->belongsToMany(Ingrediente::class);
    }
}
