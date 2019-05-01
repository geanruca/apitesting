<?php

namespace App;

use App\Pedido;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pedidos()
    {
        return $this->belongsToMany('App\Pedido','id_usuario');
    }
    public function accessTokens()
    {
        return $this->hasMany('App\OauthAccessToken');
    }
    public function scopeConductoresDisponiblesPorFecha($query,$fecha,$limiteMaximoDeEnviosPorConductor = 32){
        $lim = $limiteMaximoDeEnviosPorConductor;
        $conductores_copados = [];
        $conductores = User::where('role_id','3')->get();
        $conductores_ids = $conductores->pluck('id')->toArray();
        foreach($conductores as $conductor){
            $pedidos = Pedido::where('id_conductor','=',$conductor->id)
            ->where('fecha_recepcion',$fecha)
            ->get();

            if($pedidos->count()>=$lim){
                array_push($conductores_copados,$conductor->id);
            }
        }
        return $query->whereIn('id',$conductores_ids)
        ->whereNotIn('id',$conductores_copados)
        ->select('id as id_conductor','name','celular')
        ->get();

        
    }
}
