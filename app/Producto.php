<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // public function empresa()
    // {
    //     return $this->hasOne('App\Empresa','id_empresa');
    // }
    public function comuna()
    {
        return $this->hasOne('App\Comuna','id_comuna');
    }
    // public function tienda()
    // {
    //     return $this->belongsTo('App\Tienda','id_tienda');
    // }

}
