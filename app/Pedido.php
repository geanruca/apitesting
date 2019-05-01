<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // protected $dateFormat = 'd.m.Y';
    
    public function user(){
        return $this->hasOne('App\User','id','id_usuario');
    }
    public function driver(){
        return $this->hasOne('App\User','id','id_conductor');
    }
    public function comuna(){
        return $this->hasOne('App\Comuna','id','id_comuna');
    }
}
