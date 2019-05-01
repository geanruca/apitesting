<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Phone Wall - Startup</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/startup-materialize.min.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar dark absolute">
      <div class="nav-wrapper">
        <a href="horizontal-half.html" class="brand-logo"><i class="icon-diamond primary-color-text"></i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          {{-- <li class="active"><a class="dropdown-trigger" href="#!" data-target="pages">Pages<i class="material-icons right">arrow_drop_down</i></a></li> --}}
          <li><a href="#portafolio">Portafolio</a></li>
          <li><a href="#">Nuestro equipo</a></li>
          <li><a href="#contacto">Contacto</a></li>
        </ul>

        {{-- <ul id="pages" class="dropdown-content">
          <li><a href="horizontal-half.html">Horizontal Halves</a></li>
          <li><a href="sierra.html">Zoom Out</a></li>
          <li><a href="circle-reveal.html">Circle Reveal</a></li>
          <li><a class="active" href="phone-wall.html">Phone Wall</a></li>
          <li><a href="element-transitions.html">Element Transitions</a></li>
          <li><a href="basic-elements.html">Basic Elements</a></li>
          <li><a href="card-shuffle.html">Shuffle</a></li>
          <li><a href="postcards.html">Postcards</a></li>
        </ul> --}}

        <a href="#" data-target="slide-out" class="sidenav-trigger button-collapse right"><i class="material-icons">menu</i></a>
      </div>
    </nav>
    <ul id="slide-out" class="sidenav">
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li class="bold">
            <a class="collapsible-header waves-effect waves-teal active">Portafolio Logistica</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#aguaclean">Agua Clean</a></li>
                <li><a href="#waterpro">WaterPro</a></li>
                <li><a href="#izigas">IziGas</a></li>
                <li><a href="#fashionspark">Fashion's Park</a></li>
                <li><a href="#AutoConsulta">AutoConsulta</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <li><a class="waves-effect waves-teal" href="#aguaclean">Agua </a></li>
      <li><a class="waves-effect waves-teal" href="#waterpro">WaterPro</a></li>
      <li><a class="waves-effect waves-teal" href="#izigas">IziGas</a></li>
      <li><a class="waves-effect waves-teal" href="#fashionspark">Fashion's Park!</a></li>
      <li><a class="waves-effect waves-teal" href="#AutoConsulta">Auto Consulta</a></li>
    </ul>

    <div class="phone-wall-intro header white full-height">
      <div class="header-background"></div>
      <div class="header-wrapper row">
        <div class="col s12 m10 offset-m1 valign-wrapper">
          <div class="valign">
            <h1>Startup!</h1>
            <span class="tagline">Show off your business in a whole new way.</span>
            <button class="read-more"><i class="icon-caret-down"></i></button>
          </div>
        </div>
        <div class="col s12 m10 offset-m1 column-wrapper">
          <div class="column-two">
            
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AguaClean/Pedidos.png)"></div>
            </div>
            <div class="phone-preview-sizer">
                <div class="phone-preview"></div>
                <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AguaClean/Login.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AguaClean/Productos.png)"></div>
            </div>
          </div>
          <div class="column-one">
                <div class="phone-preview-sizer">
                    <div class="phone-preview"></div>
                    <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AutoConsulta/Login.png)"></div>
                </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AutoConsulta/Carro.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AutoConsulta/Consulta.png)"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/AutoConsulta/Login.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/1.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/2.png)"></div>
            </div>
          </div>
          <div class="column-one">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/3.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/4.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/5.png)"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/4.png)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url{{ URL::to('/') }}/images/gotitaroja.jpg)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url(http://placehold.it/530x990)"></div>
            </div>
          </div>
          <div class="column-one">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/mgv/5.png)"></div>
            </div>
            <div class="phone-preview-sizer">
                    <div class="phone-preview"></div>
                    <div class="image-container default" style="background-image:url({{ URL::to('/') }}/images/gotitazul.jpg)"></div>
                  </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url(http://placehold.it/530x990)"></div>
            </div>
          </div>
          <div class="column-two">
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url(http://placehold.it/530x990)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url(http://placehold.it/530x990)"></div>
            </div>
            <div class="phone-preview-sizer">
              <div class="phone-preview"></div>
              <div class="image-container default" style="background-image:url(http://placehold.it/530x990)"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Features -->
    <div class="section valign-wrapper">
      <div class="container">
        <div class="row">
          <div class="col s12"><h2 class="section-title">Features</h2></div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-light-bulb"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-bolt"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-rocket"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-settings"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-umbrella"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
          <div class="col s12 m6 l4">
            <h4><i class="icon-compass"></i></h4>
            <p class="caption">This is a cool feature about your product! It really separates you from the crowd.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Pricing Tables -->
    <div class="section valign-wrapper">
      <div class="container">
        <div class="row">
          <div class="col s12 m4">
            <div class="pricing-table">
              <div class="pricing-header">
                <i class="icon-paper-plane"></i>
                <h4>Basic</h4>
                <div class="price">
                  <span class="currency">$</span>
                  <span class="dollars">9</span>
                  <span class="cents">99</span>
                </div>
              </div>
              <ul class="pricing-features">
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Pro and above.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
              </ul>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="pricing-table featured">
              <div class="pricing-header">
                <i class="icon-plane"></i>
                <h4>Pro</h4>
                <div class="price">
                  <span class="currency">$</span>
                  <span class="dollars">59</span>
                  <span class="cents">99</span>
                </div>
              </div>
              <ul class="pricing-features">
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>Pro and above.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
                <li class="pricing-feature disabled"><i class="icon-close"></i>Enterprise only.</li>
              </ul>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="pricing-table">
              <div class="pricing-header">
                <i class="icon-rocket"></i>
                <h4>Enterprise</h4>
                <div class="price">
                  <span class="currency">$</span>
                  <span class="dollars">299</span>
                  <span class="cents">99</span>
                </div>
              </div>
              <ul class="pricing-features">
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>10 product uses.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>Enterprise only.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>Enterprise only.</li>
                <li class="pricing-feature"><i class="icon-accept"></i>Enterprise only.</li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Blog -->
    <div class="section light full-height">
      <div class="container">
        <div class="row">
          <div class="col s12 center">
            <h1>blog</h1>
            <div class="row masonry-grid">
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Something Interesting</span>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Another Blog Post</span>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Click Bait Article</span>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Don't Read This!</span>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Why Are You Still Reading?</span>
                  </div>
                </div>
              </div>
              <div class="col s12 m6 l4">
                <div class="card">
                  <div class="card-image">
                    <a href="blog.html"><img src="http://placehold.it/600x400"></a>
                    <span class="card-title">Good Bye</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Us -->
    <div class="section light valign-wrapper">
      <div class="container">
        <form>
          <div class="row">
            <div class="col s12"><h2 class="section-title">Contact Us</h2></div>
            <div class="input-field col s6">
              <input id="first_name" type="text">
              <label for="first_name">First Name</label>
            </div>
            <div class="input-field col s6">
              <input id="last_name" type="text">
              <label for="last_name">Last Name</label>
            </div>
            <div class="input-field col s12">
              <textarea id="message" class="materialize-textarea"></textarea>
              <label for="message">Message</label>
              <a class="waves-effect waves-light btn-large">Button</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col s6 m3">
            <img class="materialize-logo" src="images/materialize-teal.png" alt="">
            <p>Made with love by Materialize.</p>
          </div>
          <div class="col s6 m3">
            <h5>About</h5>
            <ul>
              <li><a href="#!">Blog</a></li>
              <li><a href="#!">Pricing</a></li>
              <li><a href="#!">Docs</a></li>
            </ul>
          </div>
          <div class="col s6 m3">
            <h5>Connect</h5>
            <ul>
              <li><a href="#!">Community</a></li>
              <li><a href="#!">Subscribe</a></li>
              <li><a href="#!">Email</a></li>
            </ul>
          </div>
          <div class="col s6 m3">
            <h5>Contact</h5>
            <ul>
              <li><a href="#!">Twitter</a></li>
              <li><a href="#!">Facebook</a></li>
              <li><a href="#!">Github</a></li>
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