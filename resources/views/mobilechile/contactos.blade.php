<!doctype html>
<html>

  <body>
    <div class="container">
      <h1>Lista de contactos</h1>
      <table>
          <thead>
              <th>nombre</th>
              <th>telefono</th>
              <th>email</th>
              <th>negocio</th>
              <th>notas</th>
              <th>fecha</th>
          </thead>
      @forelse ($c as $contacto)
          <tr>
              <td>{{$contacto->nombre}}</td>
              <td>{{$contacto->telefono}}</td>
              <td>{{$contacto->email}}</td>
              <td>{{$contacto->negocio}}</td>
              <td>{{$contacto->notas}}</td>
              <td>{{$contacto->created_at}}</td>
          </tr>
      @empty
          Nadie más a quién contactar
      @endforelse
      </table>
    </div>

  
  </body>
</html>