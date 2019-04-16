<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promociones';

    public function productos(){
        return $this->belongsTo('App\Producto','id_producto');
    }
}
