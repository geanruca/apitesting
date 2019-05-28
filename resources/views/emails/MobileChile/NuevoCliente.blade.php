<h1> Nuevo Cliente </h1>
<b>nombre  : </b> <span>{{ $contacto->nombre}} </span> <br>
<b>telefono: </b> <span>{{ $contacto->telefono}} </span> <br>
<b>email   : </b> <span>{{ $contacto->email}} </span> <br>
<b>negocio : </b> <span>{{ $contacto->negocio}} </span> <br>
<br>
<b> Hágala! </b>
<table>
    <thead>
        <th>nombre</th>
        <th>telefono</th>
        <th>email</th>
        <th>negocio</th>
        <th>notas</th>
        <th>estado</th>
    </thead>
@forelse ($otros as $otro)
    <tr>
        <td>{{$otro->nombre}}</td>
        <td>{{$otro->telefono}}</td>
        <td>{{$otro->email}}</td>
        <td>{{$otro->negocio}}</td>
        <td>{{$otro->notas}}</td>
        <td>{{$otro->estado}}</td>
    </tr>
@empty
    Nadie más a quién contactar
@endforelse
</table>