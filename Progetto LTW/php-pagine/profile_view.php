<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] != "GET" || !$_SESSION["loggedinusers"]) {
    header("Location: ./login.php");
}
include "../php-function/connection.php";

$username = $_GET['user'];

$me = $_SESSION['email'];

$query = "SELECT email from utente where username=$1;";
$result = pg_query_params($dbconn,$query,array($username));
if($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
  $email_user = $line['email'];
}
else{
  echo 'OOPS SOMETHING WENT WRONG';
  exit;
}

//SE L'UTENTE SU CUI HO CLICKATO SONO IO VADO DA YOURPROFILE
if($email_user == $me){
    header("Location: ./YourProfile.php");
}

$query = "SELECT * FROM utente WHERE username=$1;";

$result = pg_query_params($dbconn,$query,array($username));

if($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
    $email = $line['email'];
    $nome = $line['nome'];
    $cognome = $line['cognome'];
    $citta = $line['citta'];
    $nazione = $line['nazione'];
    $numfollower = $line['numfollower'];
    $numlike = $line['numlike'];
    $numarticles = $line['numarticles'];
    $foto_profilo = pg_unescape_bytea($line['foto_profilo']);
    $eta = $line['eta'];
}
else{
    echo "ERROR RETRIEVING PROFILE";
}

$query = "SELECT * from follow where segue=$1 and seguito=$2;";
$result = pg_query_params($dbconn, $query, array($me, $email_user));
if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $value_button = "Following";
} else {
    $value_button = "Follow";
}

///gestione charts
$startDate = '2023-04-14';
$endDate = date("y-m-d",null);
$startTimestamp = strtotime($startDate);
$endTimestamp = strtotime($endDate);
$date = array();
$valori = array();
for ($i = $startTimestamp; $i <= $endTimestamp; $i += 86400) {
  $date[] = date('Y-m-d', $i);
}
foreach ($date as $date_giorno) {
  $query = "SELECT count(*) as valore FROM articolo WHERE utente=$1 and data='$date_giorno'";
  $query_commenti="SELECT count(*) as valore FROM commento WHERE utente=$1 and data='$date_giorno'";
  $result = pg_query_params($dbconn, $query, array($email_user));
  $result_commenti=pg_query_params($dbconn, $query_commenti, array($email_user));
  if ($result) {
    $row = pg_fetch_assoc($result);
    $valori[] = $row['valore'];
  } else {
    $valori[] = 0;
  }
  if($result_commenti){
    $row_com = pg_fetch_assoc($result_commenti);
    $valori_commenti[]=$row_com['valore'];
  }
  else{
    $valori_commenti[]=0;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/stili.css" />
  <link rel="stylesheet" href="../css/profile_view.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>ProfileView</title>
</head>

<body>
<header>
    <div class="container p-0">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
        <div class="search-bar" id="search_bar">
          <input type="text" class="search-bar-text" placeholder="Search anything" id="Search_input" autocomplete="off"
            onkeyup="showHint(this.value)" />
          <button  id="bottone_ricerca">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <a class="my_navbar_login" style="color: black; opacity: 100%" href="javascript: void(0);"
          onclick="see_or_unsee_form();" value="Login"> <?php if (isset($_SESSION["loggedinusers"]) && $_SESSION["loggedinusers"] == true) {
            echo "<img class='immagine-profilo' src='data:image/jpg;charset=utf8;base64," . $_SESSION['foto_profilo'] . "'>";
          } else {
            echo "
                    <i class='fa-solid fa-user-plus icona_utente' aria-hidden='false'
                        aria-valuetext='Accedi Ora'></i>";
          } ?></a>
      </nav>
      <div class="form_popup">
        <form action="../php-function/no-login.php" method="POST" class="form-container" name="logout_ema" id="my_form">
          <button type="submit" class="btn">Log Out</button>
        </form>
      </div>
    </div>
  </header>
  <div class="search-results d-flex" style="color: black;">
    <div id="search_results" class="d-flex"></div>
  </div>
    <div class="header_page header pt-5 pt-lg-8 d-flex align-items-center" style="
          min-height: 500px;
          background-image: url('../images/banner-profilo.jpg');
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
            <h1 class="display-3 text-white">Hello there!
             
            </h1>
            <p class="text-white mt-0 mb-5">
              You are looking at <?php echo $username; ?>'s page!
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
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo ($foto_profilo); ?>" class="rounded-circle" />
                  </a>
              
                  
                </div>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col mt-5" id="colonna_elementi">
                <div class='row justify-content-center mt-5'>
                  <button type='button' id='btn-follow' class='btn follow_button' onclick="FollowUpdate('<?php echo $me; ?>','<?php echo $email_user; ?>');"><?php echo $value_button; ?></button>
              </div>
                  <div class="my_profile_stats d-flex justify-content-center mt-md-5 mb-sm-5">
                    <div>
                      <p class="my_heading" id='follower_count'>
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
                        <?php echo htmlspecialchars($numlike); ?>
                      </p>
                      <p class="my_description">Likes</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mb-5">
              <h3>
                <?php echo htmlspecialchars($nome . " " . $cognome); ?> <span class="font-weight-light"> 22</span>
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
        <!--INIZIO BOX-->
        <div class="col-xl-8 order-xl-2">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0"><?php echo $username ?>'s account</h3>
                </div>
              </div>
            </div>
                <div class="card-body">
                <canvas id="graficoAttivita" class="canvas"></canvas>
                </div>
          </div>
        </div>
      </div>
    </div>
 

    <div class="container mt-5">
      <h2>Articles</h2>
      <div class="d-flex row">
        <div class="col-md-12">
          <div id='tabellaAppend'>
            <!--prime righe della tabella(max 3) -->
            <?php
                $query_articles = 'SELECT * FROM articolo_con_username_e_media
              WHERE email=$1 
              order by id DESC 
              offset 0
              fetch first 9 rows only;';
                $result_articles = pg_query_params($dbconn, $query_articles, array($email));
                $i = 0;

                while ($line = pg_fetch_array($result_articles, null, PGSQL_ASSOC)) {
                  $media = pg_unescape_bytea($line['contenuto']);
                  $titolo = $line['titolo'];
                  $desc = $line['descrizione'];
                  $id = $line['id'];
                  $data = $line['data'];
                  if ($i == 0 || $i == 3 || $i == 6) {
                    echo "<div class='row'>";
                  }
                  echo "<div class='col-lg-4 mt-3 align-middle'>
                      <div class='card'>
                        <div class='container container-fluid d-flex img-fluid'>
                          <img class='card-img-top article_imgs img-fluid' 
                              src='data:image/jpeg;charset=utf8;base64,$media'>
                         </div>
                          <div class='card-body'>
                            <div class='container container-fluid container_testi'>
                              <div class='row'>
                                <a href='./post_view.php?article=$id'>
                                  <h5 class='card-title'>$titolo</h5>
                                </a>
                              </div>
                              <div class='row'>
                                <p class='card-text'>$desc</p>
                              </div>
                            </div>
                            <div class='row justify-content-end'>
                              <span>$data</span>
                            </div>
                          </div>
                        </div>
                      </div>";
                  if ($i == 2 || $i == 5 || $i == 8) {
                    echo "</div>";
                  }
                  $i += 1;

                }
                ?>
            <!-- altre righe della tabella generate con ajax-->
          </div>
        </div>
      </div>
    
    <div class="container-fluid" id="loading-modal" style="display:none;">
    <div class="modal-content">
      <div class="spinner"></div>
    </div>
    </div>
  </div>

  </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="../js/metodi.js"></script>
  <script src='../js/like_follow.js'></script>
  <script src="../js/profileViewArticles.js"></script>
  <script>
    const loadingModal = document.getElementById('loading-modal');
    window.addEventListener("scroll", () => {
    const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

    // Verifica se si è raggiunta la fine della pagina
    if (scrollTop + clientHeight >= scrollHeight) {
      loadingModal.style.display = 'block';
      MostraArticoli('<?php echo $email?>').then(()=>{
        loadingModal.style.display = 'none';
      }).catch((error) => {
        console.error(error);
      });
    }
    });
  </script>
  <script>
  var ctx = document.getElementById('graficoAttivita').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($date); ?>,
      datasets: [{
        label: 'Articles',
        data: <?php echo json_encode($valori); ?>,
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 2,
      },
      {label: 'Comments',
        data: <?php echo json_encode($valori_commenti); ?>,
        borderColor: 'rgba(10, 99, 132, 1)',
        borderWidth: 2,
      }]
    },
    });
</script>


</html>