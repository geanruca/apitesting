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

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mobile Chile - Aplicaciones móviles para tu celular</title>
    <meta name="description" content="Lleva tu negocio al siguiente nivel. Automatiza tus procesos y comanda las notificaciones de todo desde la comodidad de tu smartphone">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/startup-materialize.min.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
      @if((session()->has("flash")))
        <div class="alert alert-success"><span class="green-text">{{session("flash")}}</span></div>
      @endif
    
    <div class="phone-wall-intro header white full-height">
      <div class="header-background"></div>
      <div class="header-wrapper row">
        <div class="col s12 m10 offset-m1 valign-wrapper">
          <div class="valign">
            <h2>Mobile Chile!</h2>
            <span class="tagline">Lleva tu idea, o negocio al celular</span>
            <button class="read-more"><i class="icon-caret-down"></i></button>
          </div>
        </div>
        <div class="col s12 m10 offset-m1 column-wrapper">
          <div class="column-two">
            
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_1.png)"></div>
            </div>
            <div class="phone-preview-sizer">
                <div class="phone-preview"></div>
                <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_2.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_3.png)"></div>
            </div>
          </div>
          <div class="column-one">
                <div class="phone-preview-sizer">
                    <div class="phone-preview"></div>
                    <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_4.png)"></div>
                </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_5.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_6.png)"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_7.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_8.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_9.png)"></div>
            </div>
          </div>
          <div class="column-one">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_11.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_10.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_12.png)"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_13.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_14.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_15.png)"></div>
            </div>
          </div>
          <div class="column-one">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/Screenshot_16.png)"></div>
            </div>
            <div class="phone-preview-sizer">
                    <div class="phone-preview"></div>
                    <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/0.jpg)"></div>
                  </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/1.png"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/2.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/3.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/images') }}/5.png)"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <!-- Contact Us -->
    
    <div class="section light valign-wrapper" id="#cafe">
      <div class="container">
        <form method="POST" action="/contacto">
          @csrf
          <div class="row">
            <form>
            <div class="col s12"><h2 class="section-title">Te invito un café</h2>
              
           </div>
            <div class="input-field col s6">
              <input name="nombre" id="first_name" type="text">
              <label for="first_name">Nombre</label>
            </div>
            <div class="input-field col s6">
              <input name="email" id="email" type="text">
              <label for="email">Email</label>
            </div>
            <div class="input-field col s6">
              <input name="telefono" id="phone" type="text">
              <label for="phone">Celular</label>
            </div>
            <div class="input-field col s12">
              <textarea name="negocio" id="message" class="materialize-textarea"></textarea>
              <label for="message">Cuéntame de tu negocio</label>
              <button type="submit" class="waves-effect waves-light btn-large">Vamos por ese café!</button>
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
            <img class="materialize-logo" src="images/materialize-teal.png)" alt="">
            <p>Especializados en transformar tu negocio en una aplicación móvil.</p>
          </div>
          <div class="col s6 m3">
            <h5>Para emergencias y trabajos urgentes</h5>
            <ul>
              <h5>WSP: +569 45263469</h5>
            </ul>
          </div>
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