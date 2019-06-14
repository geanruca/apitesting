@component('mail::message')
<b>Usted tiene un nuevo pedido pagado online por </b>{{$user->name}}. <br>
<b>Se han comprado: </b>{{$pedido->detalle_productos}} <br>
<b>Por un total de: </b>${{$pedido->total_pago}} <br>
<b>Pagó con: </b>{{$pedido->medio_de_pago}} <br>
<b>El pedido debe ser entregado el: </b>{{$pedido->fecha_recepcion}} entre {{$pedido->horario_recepcion_inicio}} y {{$pedido->horario_recepcion_final}} hrs. <br>

Contacte a su cliente llamando a {{$user->name}} al {{$user->celular}} <br>
O puede enviarle un email a {{$user->email}} <br>

@component('mail::button', ['url' => 'https://www.mobilechile.app/aguaclean/pedidos'])
Vea todos sus pedidos aquí.
@endcomponent

Muchas gracias<br>
Atte. MobileChile.app
@endcomponent
