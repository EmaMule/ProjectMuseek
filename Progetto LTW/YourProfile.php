<?php
session_start();
if (!isset($_SESSION["loggedinusers"]) || $_SESSION["loggedinusers"] != true) {
  header("Location: login.html");
}

include "./connection.php";
$query = "SELECT * from utente where email=$1;";

$result = pg_query_params($dbconn, $query, array($_SESSION["email"]));

$line = pg_fetch_array($result, null, PGSQL_ASSOC);


$numlike = $line["numlike"];
$numfollower = $line["numfollower"];
$foto_profilo = $line["foto_profilo"]; 
$numarticles = $line["numarticles"];
$nome = $line["nome"];
$cognome = $line["cognome"];
$eta = $line["eta"];
$nazione = $line["nazione"];
$citta = $line["citta"];


if(!isset($foto_profilo)){
  $foto_profilo = file_get_contents("images/Vegeta.png");
  $img = base64_encode($foto_profilo);
}
else{
  $img = base64_encode($foto_profilo);
}

?>
<!--OSSERVAZIONE: UN UTENTE CHE SI è REGISTEATO E VA SU your profile non vede mai il count dei follower
aumentare, deve fare login-logout-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./bootstrap-4.0.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./stili.css" />
  <link rel="stylesheet" href="./urpp.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
  <title>YourProfile</title>
</head>

<body>
  <header>
    <div class="container p-0">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand my_brand" href="homepage.php">Museek.com</a>
        <button class="navbar-toggler ml-auto" id="bottone_toggle" value="NOT clicked" type="button"
          data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ml-3 justify-content-center" id="lista_navbar">
            <li class="nav-item my_nav-item">
              <a class="nav-link" href="archive.php">Latest News</a>
            </li>
            <li class="nav-item my_nav-item">
              <a class="nav-link" href="Post.php">For You</a>
            </li>
            <li class="nav-item my_nav-item">
              <a class="nav-link" href="YourProfile.php">Your Profile</a>
            </li>
            <li class="nav-item my_nav-item">
              <a class="nav-link" href="aboutus.php">About Us</a>
            </li>
          </ul>
        </div>
        <form action="" class="search-bar" id="search_bar">
          <input type="text" class="search-bar-text" placeholder="Search anything" id="Search_input" />
          <button type="submit" id="bottone_ricerca">
            <i class="fas fa-search"></i>
          </button>
        </form>
        <a class="my_navbar_login" style="color: black; opacity: 100%" href="javascript: void(0);"
          onclick="see_or_unsee_form();" value="Login"><i class="fa-solid fa-user-plus icona_utente" aria-hidden="false"
            aria-valuetext="Accedi Ora"></i></a>
      </nav>
      <div class="form_popup">
        <form action="./no-login/no-login.php" method="POST" class="form-container" id="my_form">
          <button type="submit" class="btn">Log Out</button>
        </form>
      </div>
    </div>
  </header>

  <body>
    <div class="header_page header pt-5 pt-lg-8 d-flex align-items-center" style="
          min-height: 500px;
          background-image: url(./images/pexels-daniel-reche-3721941.jpg);
          background-size: cover;
          background-position: center;
        ">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <!--IMPORTANTE , qua User dovrà essere cambiato dinamicamente a seconda di chi è l'utente che ha fatto il login-->
            <h1 class="display-3 text-white">Hello
              <?php echo htmlspecialchars($nome) ?>
            </h1>
            <p class="text-white mt-0 mb-5">
              This is your profile page. You can see your articles and the
              progress you made!
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt-5">
      <div class="row mx-0">
        <div class="col-xl-3 order-xl-1 mb-5 mb-xl-0">
          <div class="card my_profile_card">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="my_profile_card_image">
                  <a href="#">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo ($img); ?>" class="rounded-circle" />
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col mt-5" id="colonna_elementi">
                  <div class="my_profile_stats d-flex justify-content-center mt-md-5 mb-sm-5">
                    <div>
                      <p class="my_heading">
                        <?php echo htmlspecialchars($numfollower); ?>
                      </p>
                      <p class="my_description">Followers</p>
                    </div>
                    <div>
                      <p class="my_heading">
                        <?php echo htmlspecialchars($numarticles); ?>
                      </p>
                      <p class="my_description">Articles</p>
                    </div>
                    <div>
                      <p class="my_heading">
                        <?php echo htmlspecialchars($numlike);?>
                      </p>
                      <p class="my_description">Likes</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mb-5">
              <h3>
                <?php echo htmlspecialchars($nome . " " . $cognome); ?> <span
                  class="font-weight-light"> 22</span>
              </h3>
              <div class="h5 font-weight-300">
                <i class="my_location mr-2">
                  <?php if (isset($citta) and isset($nazione)) {
                    echo htmlspecialchars($citta . " , " . $nazione);
                  } else {
                    echo "&nbsp";
                  }
                  ?>
                </i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-2">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My Account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="./yourprofile/yourprofile.php">
                <h6 class="heading-small mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" name="inputUsername"
                          class="form-control form-control-alternative" placeholder="Username" value=<?php echo htmlspecialchars($_SESSION["username"]); ?> />
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" name="inputEmail"
                          class="form-control form-control-alternative" placeholder="email" readonly value=<?php echo htmlspecialchars($_SESSION["email"]); ?> />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" name="inputName"
                          class="form-control form-control-alternative" placeholder="First name" value=<?php echo htmlspecialchars($nome); ?> />
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" name="inputCognome"
                          class="form-control form-control-alternative" placeholder="Last name" value=<?php echo htmlspecialchars($cognome); ?> />
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" name="inputCitta"
                          class="form-control form-control-alternative" placeholder="City" value=<?php if ($citta) {
                            echo htmlspecialchars($citta);
                          } else {
                            echo "&nbsp";
                          } ?> />
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" name="inputNazione"
                          class="form-control form-control-alternative" placeholder="Country" value=<?php if ($nazione) {
                            echo htmlspecialchars($nazione);
                          } else {
                            echo "&nbsp";
                          } ?> />
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="container-fluid">
                  <button type="submit" class="btn btn-outline-success float-right">Edit profile</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <h2>Your Articles</h2>
      <table class="table">
        <tbody>
          <tr>
            <td class="align-middle">
              <div class="card">
                <img class="card-img-top articles_imgs"
                  src="images/KW_20DONDA_20LISTENING_20EVENT_GUNNER_20STAHL_207.webp" alt="Card image cap" />
                <div class="card-body">
                  <h5 class="card-title">Titolo dell'articolo 1</h5>
                  <p class="card-text">Breve descrizione dell'articolo 1.</p>
                  <a href="#" class="btn btn-primary">Leggi di più</a>
                </div>
              </div>
            </td>
            <td class="align-middle">
              <div class="card">
                <img class="card-img-top articles_imgs" src="images/best-albums-of-2016.avif" alt="Card image cap" />
                <div class="card-body">
                  <h5 class="card-title">Titolo dell'articolo 2</h5>
                  <p class="card-text">Breve descrizione dell'articolo 2.</p>
                  <a href="#" class="btn btn-primary">Leggi di più</a>
                </div>
              </div>
            </td>
            <td class="align-middle">
              <div class="card">
                <img class="card-img-top articles_imgs" src="images/Isole-Cook.jpg" alt="Card image cap" />
                <div class="card-body">
                  <h5 class="card-title">Titolo dell'articolo 3</h5>
                  <p class="card-text">Breve descrizione dell'articolo 3.</p>
                  <a href="#" class="btn btn-primary">Leggi di più</a>
                </div>
              </div>
            </td>
          </tr>
          <!-- altre righe della tabella -->
        </tbody>
      </table>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="./metodi.js"></script>
</body>

</html>
>