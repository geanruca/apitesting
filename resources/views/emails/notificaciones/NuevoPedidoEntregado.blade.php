@component('mail::message')
<b>Se ha entregado un pedido a </b>{{$user->name}}. <br>
<b>Se entregaron: </b>{{$pedido->detalle_productos}} <br>
@if($pedido->estado_pago == 'PAGADO')
<b>Por recibió como pago total: </b>${{$pedido->total_pago}} <br>
<b>Se pagó con: </b>{{$pedido->medio_de_pago}} <br>
@else
<b>Se pagón con: </b> Efectivo<br>
@endif

<b>El pedido se entregó: </b>{{$pedido->updated_at}} <br>

Puede contactar a su cliente llamando a {{$user->name}} al {{$user->celular}} <br>
O puede enviarle un email a {{$user->email}} <br>

@component('mail::button', ['url' => 'https://www.mobilechile.app/aguaclean/pedidos'])
Vea todos sus pedidos aquí.
@endcomponent

Muchas gracias<br>
Atte. MobileChile.app
@endcomponent
