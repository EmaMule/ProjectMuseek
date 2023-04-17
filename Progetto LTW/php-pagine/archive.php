<?php
session_start();
include "../php-function/connection.php";

if (!isset($_SESSION['indice-paginazione'])) {
    $_SESSION['indice-paginazione'] = 0;
}

//OTTENIAMO L'OFFSET PER LA QUERY
$index = $_SESSION['indice-paginazione'] * 10;

//prepariamo query per forward o backward
$query = 'SELECT id, username, foto_profilo, nome, 
    contenuto, descrizione, titolo,
    data, ora, numlikes 
    from articolo_con_username_e_media 
    order by id DESC
    offset $1
    fetch first 10 row only;';

$result = pg_query_params($dbconn, $query, array($index));

if (!$result) {
    echo "An error has occurred whilst loading the articles!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MusicNews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/stili.css" />
    <link rel="stylesheet" href="../css/archive_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
</head>

<body class="body_top_g">
    <!--NAVBAR-->
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
                <?php if (!isset($_SESSION["loggedinusers"]) || $_SESSION["loggedinusers"] != true) {
                    echo "
                <form action='../php-function/login.php' method='POST' class='form-container' name='login_ema' id='my_form'>
                    <h1 class='my_h1'>Login</h1>
                    <label for='email'><b>Email</b></label>
                    <input type='text' placeholder='Enter Email' name='inputEmail' required />

                    <label for='psw'><b>Password</b></label>
                    <input type='password' placeholder='Enter Password' name='inputPassword' required />

                    <button type='submit' class='btn'>Login</button>
                    <p class='messaggio'>
                        Not registered? <a href='login.php'>Create an account</a>
                    </p>
                    <p class='messaggio'>
                        Password Forgotten? <a href='#'>Click here</a>
                    </p>
                </form>";
                } else {
                    echo "<form action='../php-function/no-login.php' method='POST' class='form-container' name='logout_ema' id='my_form'>
                    <button type='submit' class='btn'>Log Out</button>
                  </form>";
                }
                ?>
            </div>
        </div>
    </header>
    <!--FINE NAVBAR-->
    <div class="search-results d-flex" style="color: black;">
        <div id="search_results" class="d-flex"></div>
    </div>
    <!--BODY-->
    <div class="header_page header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="
        min-height: 450px;
        background-size: cover;
        background-position: center;
        background-image: url('../images/Rolling-Loud.jpg');
      ">
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <!--IMPORTANTE , qua User dovrà essere cambiato dinamicamente a seconda di chi è l'utente che ha fatto il login-->
                    <h1 class="display-3 text-white" style="font-weight: 1000;">Your Archive</h1>
                    <p class="text-white mt-0 mb-5" style="font-weight: 600;">
                        See the latest news from the best artists in the world.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--FINE BANNER-->
    <div class="container">
        <div class="row d-flex container-fluid justify-content-center">
            <div class="col-md-9 flex-grow-2">
                <ul class="article_ul_top_g">
                    <?php
                    while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                        $id = $line["id"];
                        $username = $line["username"];
                        $titolo = $line["titolo"];
                        $descrizione = $line["descrizione"];
                        $numlikes = $line["numlikes"];
                        $data = $line['data'];
                        $ora = $line['ora'];

                        $foto_profilo = $line['foto_profilo'];
                        $foto_profilo = (pg_unescape_bytea($foto_profilo));

                        $media = $line['contenuto'];
                        $media = pg_unescape_bytea($media);

                        echo "

                              <li class='article_top_g article_container_top_g' id='article-0'>
                                <div class='container d-flex container-fluid flex-wrap align-items-start'>
                                    <header class='h5 article_user_text_top_g'>
                                    <a href='./profile_view.php?user=$username'>
                                        <img class='article_little_icon_top_g' src='data:image/jpg;charset=utf8;base64,$foto_profilo'> $username
                                    </a>
                                    </header>
                                </div>
                                <hr>
                                <div class='container d-flex justify-content-start container-title'>
                                <a href='./post_view.php?article=$id'>
                                    <header class='h3 article_heading_top_g'>
                                        $titolo 
                                    </header>
                                </a>
                                </div>
                                <div class='container d-flex justify-content-center mb-2 mt-2'>
                                <img src='data:image/jpg;charset=utf8;base64,$media' class='article_img_top_g' />
                                </div>
                                <hr>
                                <p class='p-1 article_text_top_g'>
                                    $descrizione
                                </p>
                            </li>
                              
                              ";

                    }
                    ?>


                </ul>
                <ul class="arrow_icons_top_g">
                    <li>
                        <a><ion-icon name="play-back-circle-outline"
                                onclick="backwardBackward();"></ion-icon></ion-icon></a>
                    </li>
                    <li>
                        <a><ion-icon name="caret-back-circle-outline" onclick="backward();"></ion-icon></a>
                    </li>
                    <li>
                        <a><ion-icon name="caret-forward-circle-outline" onclick="forward();"></ion-icon></a>
                    </li>
                    <li>
                        <a><ion-icon name="play-forward-circle-outline" onclick="forwardForward();"></ion-icon></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--FINE CARRELLATA ARTICOLI-->

    <div class="container-fluid">
    </div>
    <div class="container container-fluid">
        <div class="row d-flex align-items-md-vertical">
            <div class="col-md">
                <div class="container container-fluid margin_divider">
                    <header class="h3 header_tag_top_g">WHAT IS THE ARCHIVE</header>
                    <div class="container container-fluid d-flex justify-content-center">
                        <img src="../images/archive-img-0.jpg" class="archive_img_top_g">
                    </div>
                    <p class="archive_text_top_g">The archive is the place where you can access all of our user's
                        blogposts!
                        If you publish a blogpost or a newsletter users will be able to access it from the archive. If
                        you scroll
                        down you will see four arrows to load more pages from our archive. Just click on the title of a
                        blogpost
                        and get ready to enjoy our community's content!
                    </p>
                </div>
            </div>
            <div class="col-md">
                <div class="container margin_divider">
                    <header class="h3 header_tag_top_g">GET IN TOUCH WITH OTHERS</header>
                    <div class="container container-fluid d-flex justify-content-center">
                        <img src="../images/archive-img-2.jpg" class="archive_img_top_g">
                    </div>
                    <p class="archive_text_top_g">Our blogposts are made from users from all around the world.
                        Broadcast yourself and share your passion! Comment on other
                        people blogposts and share your opinions! We are an open
                        community of music enthusiasts and everyone is welcome! ora
                    </p>
                </div>
            </div>
            <div class="col-md">
                <div class="container margin_divider">
                    <header class="h3 header_tag_top_g">SHARE YOUR PASSION</header>
                    <div class="container container-fluid d-flex justify-content-center">
                        <img src="../images/archive-img-1.jpg" class="archive_img_top_g">
                    </div>
                    <p class="archive_text_top_g">Publish your music, get feedback from the community,
                        share your passion! Open now your personal blog and it'll end up in our archive.
                        The only rule is that the posts must be about music topics! Scrivo altre cose per capire come
                        siamo messi forza la magica roma! Forzissima la roma! Ci siamo ora credo, altezza perfetta.
                        Altezzona perfettona! Forza dai!

                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--FINE BODY-->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../js/metodi.js"></script>
    <script src='../js/archive.js'></script>

</body>

</html>