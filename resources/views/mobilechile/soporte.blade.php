<!doctype html>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-139428697-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-139428697-1');
    </script>
    <link rel="shortcut icon" type="image/png" href="/images/telefono-inteligente.png" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mobile Chile - Aplicaciones móviles para tu celular</title>
    <meta name="description" content="Lleva tu negocio al siguiente nivel. Automatiza procesos y comanda las notificaciones desde tu smartphone">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/startup-materialize.min.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
      @if((session()->has("flash")))
        <div class="alert alert-success"><span class="white-text">{{session("flash")}}</span></div>
      @endif
    

    
    <div class="section light valign-wrapper" id="#cafe">
      <div class="container">
        <form method="POST" action="/soporte">
          @csrf
          <div class="row">
            <form>
            <div class="col s12"><h2 class="section-title">Enviar Ticket de Soporte</h2>
              
           </div>
            <div class="input-field col s6">
              <input name="nombre" id="first_name" type="text" required>
              <label for="first_name">Nombre</label>
            </div>
            <div class="input-field col s6">
              <input name="email" id="email" type="text" required>
              <label for="email">Email</label>
            </div>
            <div class="input-field col s6">
              <input name="telefono" id="phone" type="text" required>
              <label for="phone">Celular</label>
            </div>
            <div class="input-field col s12">
              <textarea name="mensaje" id="mensaje" required class="materialize-textarea"></textarea>
              <label for="mensaje">Mensaje</label>
              <button type="submit" class="waves-effect waves-light btn-large">Enviar</button>
            </div>
          </form>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col s6 m3">
            <img class="materialize-logo" src="" alt="">
            <p>Especializados en transformar tu negocio en una aplicación móvil.</p>
          </div>
          {{-- <div class="col s6 m3">
            <h5>Para emergencias y trabajos urgentes</h5>
            <ul>
              <h5>WSP: +569 45263469</h5>
            </ul>
          </div> --}}
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/materialize.min.js"></script>

    <!-- External libraries -->
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <script src="js/ScrollMagic.min.js"></script>
    <script src="js/animation.gsap.min.js"></script>

    <!-- Initialization script -->
    <script src="js/startup.js"></script>
    <script src="js/init.js"></script>
  </body>
</html>