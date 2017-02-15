<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Nicolás Cieri</title>

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <!--Custom css-->
    <link type="text/css" rel="stylesheet" href="css/layout.css"  media=""/>

  </head>

  <body>
    <nav class="light-blue darken-2 ">
      <a href="#" class="brand-logo"></a>
      <div id="slide-out" class="side-nav fixed">
        <!--div class="profile">
          <div class="img-container">
            <img src="images/profile.jpg" alt="" class="appear-animation">
          </div>
        </div-->
        <div class="name">
          <h1>Nicolás Cieri</h1>
        </div>
        <ul>
          <li><a href="#!">First Sidebar Link</a></li>
          <li><a href="#!">Second Sidebar Link</a></li>
        </ul>
      </div>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </nav>

    <main>
      <div class="parallax-container">
        <div class="parallax">
          <img src="images/bkg1.png">
          <div class="parallax-text">
            <div class="profile">
              <div class="img-container">
                <img src="images/profile.jpg" alt="" class="appear-animation hoverable">
              </div>
              <h2><p class="1" >Nicolás Cieri</p></h2>
              <h3><p class="2">Front End Developer</p></h3>
              <h3><p class="2">Buenos Aires, Argentina</p></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="card hoverable appear-from-bottom-animation">
            <div class="card-image">
              <img src="images/sample-1.jpg">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
    </main>






    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script>
      

      $x=$("p[class*='2']").html();

       alert("hola"+$x);
    </script>
  </body>
</html>