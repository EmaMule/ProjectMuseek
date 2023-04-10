<?php 
session_start();
if ($_SERVER["REQUEST_METHOD"] != "GET" || !$_SESSION["loggedinusers"]) {
    header("Location: ../login.html");
}
include "../connection.php";

//variabile per far capire al db quali commenti deve prendere (se i primi 10, i secondi 10 etc...)
//NB bisogna applicare un accorgimento: se l'offset inizia da 0 trigger comunque isset o !
//quindi si inizia da 1 e nel php ogni volta si usa l'indice decrementato di 1
if(!$_SESSION['indice-commenti']){
    $_SESSION["indice-commenti"] = 1;
}

//controllo per refresh manuale


//PRENDO L'ARTICOLO TRAMITE ID
$id = $_GET['article'];
$query = "SELECT * from articolo_con_username_e_media where id=$1;";


$result = pg_query_params($dbconn, $query, array($id));


if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
    
    $titolo = $line["titolo"];
    $descrizione = $line["descrizione"];
    $numlikes = $line["numlikes"];
    $username = $line["username"];
    $data = $line["data"];
    $ora = $line["ora"];
    $nazione = $line["nazione"];
    $citta = $line["citta"];

    $autore = $line["email"];
    $utente = $_SESSION["email"];

    $foto_profilo = $line["foto_profilo"];
    $media = $line["contenuto"];
    $foto_profilo = (pg_unescape_bytea($foto_profilo));
    $media = (pg_unescape_bytea($media));


}
else{
    echo "Error, article not found!";
    exit;
   
}

//query per capire se aumentare o decrementare like. NOTA bisogna per forza farla qui perche le funzioni php
//chiamate con ajax non possono eseguire return di alcun valore

$incdec = 1;


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>PostView</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <link rel="stylesheet" href="post_view.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
            integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../stili.css" />
        <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
        </head>
    <body class="body_articolo">
        <!--NAVBAR-->
        <header>
            <div class="container p-0">
                <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
                    <a class="navbar-brand my_brand" href="../homepage.php">Museek.com</a>
                    <button class="navbar-toggler ml-auto" id="bottone_toggle" value="NOT clicked" type="button"
                        data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0 ml-3 justify-content-center" id="lista_navbar">
                            <li class="nav-item my_nav-item">
                                <a class="nav-link" href="../archive.php">Latest News</a>
                            </li>
                            <li class="nav-item my_nav-item">
                                <a class="nav-link" href="post.php">For You</a>
                            </li>
                            <li class="nav-item my_nav-item">
                                <a class="nav-link" href="../YourProfile.php">Your Profile</a>
                            </li>
                            <li class="nav-item my_nav-item">
                                <a class="nav-link" href="../aboutus.php">About Us</a>
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
                        onclick="see_or_unsee_form();" value="Login"><i class="fa-solid fa-user-plus icona_utente"
                            aria-hidden="false" aria-valuetext="Accedi Ora"></i></a>
                </nav>
                <div class="form_popup">
                    <?php if (!isset($_SESSION["loggedinusers"]) || $_SESSION["loggedinusers"] != true) {
                        echo "
                    <form action=\"../login/login.php\" method=\"POST\" class=\"form-container\" id=\"my_form\">
                        <h1 class=\"my_h1\">Login</h1>
                        <label for=\"email\"><b>Email</b></label>
                        <input type=\"text\" placeholder=\"Enter Email\" name=\"inputEmail\" required />

                        <label for=\"psw\"><b>Password</b></label>
                        <input type=\"password\" placeholder=\"Enter Password\" name=\"inputPassword\" required />

                        <button type=\"submit\" class=\"btn\">Login</button>
                        <p class=\"messaggio\">
                            Not registered? <a href=\"../login.html\">Create an account</a>
                        </p>
                        <p class=\"messaggio\">
                            Password Forgotten? <a href=\"#\">Click here</a>
                        </p>
                    </form>";
                    } else {
                        echo "<form action=\"../no-login/no-login.php\" method=\"POST\" class=\"form-container\" id=\"my_form\">
                        <button type=\"submit\" class=\"btn\">Log Out</button>
                    </form>";
                    }
                    ?>
                </div>
            </div>
        </header>
        <!--POST-->
        <div class="container container_articolo">
            <div class="row">
                <?php echo "
               <img class='articolo_icona' src='data:image/jpg;charset=utf8;base64,$foto_profilo'> 
                <div class='container_usertext'>
                    <a href='#'>$username</a>
                    <div class='sottotesto' >$citta, $nazione</div>
                </div>
               
               "
               ?>
            </div>
            <div class="articolo">
                <header class="h1 header_articolo"><?php echo "
                    $titolo
                    ";?>
                </header>
                <div class="wrapper-immagine">
                <?php echo "
                    <img class='media_articolo' src='data:image/jpg;charset=utf8;base64,$media'> 
                ";?>
                </div>
                <?php echo "
                    <p class='testo_articolo'>$descrizione</p>
                ";?>

                <header class="h5" style="text-align: right;"><?php echo "
                    $data $ora
                    "?>
                </header>
                <button type='button' id="btn-like" onclick="LikeUpdate('<?php echo $id; ?>', '<?php echo $autore;?>', '<?php echo $utente;?>');" 
                         class='btn btn-success' style="margin-top:60px; margin-bottom: 10px;">Like 
                        (<span id='likecount'><?php echo"$numlikes"; ?></span>)</button>
            </div>
            <div class="container container-commenta">
                <header class="h4">Comment:</header>
                <form action="upload_comment.php" class="form-commento" method="POST" id="form_top_g">
                    <input class="commenta-textfield" id="comment-text" type="textfield">
                    <button type='submit' class='btn btn-success' style="margin-left: 20px">Comment</button>
                </form>
            </div>
            
        </div>

        <div class="container-fluid">
        
            
            <ul id="list-comments" class="lista-commenti">
                
            </ul>

            <button type='button' onclick="mostraAltri();" id='more-comments-btn' class="btn btn-primary altri-commenti-btn" style="margin-top: 60px; margin-bottom: 60px;">More comments</button>
            
        
        </div>

        
        







        <!--FINE BODY-->
        <script
			  src="https://code.jquery.com/jquery-3.6.4.min.js"
			  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
			  crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="../metodi.js"></script>
        <script>
            function LikeUpdate(id,autore,utente){
                //incdec è il modo di far comunicare js con il php
                //il .php solo tramite echo può ritornare incdec e quindi in result avremo questo valore
                //usiamo result per aumentare o diminuire visivamente il numero di like al click, mentre nel db
                $.ajax({
                    url:'update_likes.php',
                    type: 'post',
                    data:'type=like&id='+id+'&autore='+autore+'&utente='+utente,
                }).done(function(result){
                        var incdec = parseInt(result);
                        var cur_count = jQuery('#likecount').html();
                        cur_count = parseInt(cur_count);
                        cur_count += incdec;
                        jQuery('#likecount').html(cur_count);});
            }            
        </script>
        <!--SCRIPT INSERISCI COMMENTO-->
        <script>
           $(document).ready(function(){
                $('.form-commento').submit(function (event) {
                    var text = $('#comment-text').val();
                    event.preventDefault();
                    var utente = "<?php echo $utente; ?>";
                    var id = "<?php echo $id; ?>";
                    jQuery.ajax({
                        url:'upload_comment.php',
                        type: "post",
                        data: ({testo: text, utente: '<?php echo $utente; ?>', id: '<?php echo $id ?>'})
                    }).done(function(result){
                    //creiamo il commento al volo e lo appendiamo in cima alla lista
                        result = JSON.parse(result);
                        const text = result[0];
                        const username = result[1];
                        const data = result[2];
                        const ora = result[3];
                        const foto = result[4];
                        const id_com = result[5];
                        

                        const box_commento = document.createElement("li");
                        box_commento.classList.add("container");
                        box_commento.classList.add("commento-container");
                        const img = document.createElement("img");
                        img.src = 'data:image/jpeg;charset=utf8;base64,'+foto;
                        img.classList.add("commento-img");
                        const name = document.createElement("header");
                        name.classList.add("commento-username");
                        const row = document.createElement("div");
                        row.classList.add("row");
                        const row2 = document.createElement("div");
                        row2.classList.add("row");
                        const row3 = document.createElement("div");
                        row3.classList.add("row");

                        //creiamo gli elementi di testo veri e propri dalle stringhe
                        const textnode = document.createTextNode(text);
                        const usernametextnode = document.createTextNode(username);
                        name.appendChild(usernametextnode);
                        const dataNode = document.createTextNode(data);
                        const oraNode = document.createTextNode('  '+ora);

                        box_commento.appendChild(row);
                        row.appendChild(img);
                        row.appendChild(name);
                        box_commento.appendChild(row2);
                        row2.appendChild(textnode);
                        box_commento.appendChild(row3);
                        row3.appendChild(dataNode);
                        row3.appendChild(oraNode);
                        row3.classList.add("commento-3rd-row");

                        //creiamo il delete button
                        const row4 = document.createElement("div");
                        row4.classList.add('row');
                        const btn = document.createElement("button");
                        btn.classList.add("btn");
                        btn.classList.add("btn-danger");
                        btn.setAttribute('id',id_com);
                        btn.addEventListener('click',function(e){
                            cancellaCommento(e);
                        });
                        btn.innerText = 'X';
                        row4.appendChild(btn);
                        box_commento.appendChild(row4);
                        

                        //infine inseriamo il commento all'inizio
                        document.getElementById("list-comments").insertBefore(box_commento,document.getElementById("list-comments").firstChild);

                    });

                });
                
            });
        </script>

        <!--Script per altri commenti-->
        <script>
            function mostraAltri(){
                jQuery.ajax({
                    url: 'show_comments.php',
                    type: 'post',
                    data: ({id: <?php echo $id; ?>})
                }).done(function(result){
                    //aumentiamo l'indice 
                    var i = 0;
                    //ritorniamo lato ajax un array con 10 array associativi che 
                    //sono i commenti
                    result = JSON.parse(result);

                    while(result[i]){
                        var commento = result[i];
                        const text = commento['testo'];
                        const username = commento['username'];
                        const data = commento['data'];
                        const ora = commento['ora'];
                        const foto = commento['foto_utente'];

                        const box_commento = document.createElement("li");
                        box_commento.classList.add("container");
                        box_commento.classList.add("commento-container");
                        const img = document.createElement("img");
                        img.src = 'data:image/jpeg;charset=utf8;base64,'+foto;
                        img.classList.add("commento-img");
                        const name = document.createElement("header");
                        name.classList.add("commento-username");
                        const row = document.createElement("div");
                        row.classList.add("row");
                        const row2 = document.createElement("div");
                        row2.classList.add("row");
                        const row3 = document.createElement("div");
                        row3.classList.add("row");

                        //creiamo gli elementi di testo veri e propri dalle stringhe
                        const textnode = document.createTextNode(text);
                        const usernametextnode = document.createTextNode(username);
                        name.appendChild(usernametextnode);
                        const dataNode = document.createTextNode(data);
                        const oraNode = document.createTextNode('  '+ora);

                        box_commento.appendChild(row);
                        row.appendChild(img);
                        row.appendChild(name);
                        box_commento.appendChild(row2);
                        row2.appendChild(textnode);
                        box_commento.appendChild(row3);
                        row3.appendChild(dataNode);
                        row3.appendChild(oraNode);
                        row3.classList.add("commento-3rd-row");

                        //infine inseriamo il commento 
                        document.getElementById("list-comments").appendChild(box_commento);
                        i += 1;

                        //controlliamo se il commento è dell'utente che lo sta guardando e inseriamo il delete button
                        const controllo = '<?php echo $_SESSION['username']; ?>';
                        if(controllo === username){
                            const id_com = commento['id_com'];
                            const row4 = document.createElement("div");
                            row4.classList.add('row');
                            const btn = document.createElement("button");
                            btn.classList.add("btn");
                            btn.classList.add("btn-danger");
                            btn.innerText = 'X';
                            btn.setAttribute('id',id_com);
                            row4.appendChild(btn);
                            btn.addEventListener('click',function(e){
                                cancellaCommento(e);
                            });
                            box_commento.appendChild(row4);
                        }
                    }
                });
            }

        </script>
        <script>
            function cancellaCommento(e){
                //l'unico modo trovato per ottenere l'id è passare l'evento con il target dentro
                var id = e.target.id;
                jQuery.ajax({
                    url: 'delete_comments.php',
                    type: 'post',
                    data: ({id_com: id})
                }).done(function (result){
                    const rowparent = $(e.target).parent();
                    const box_da_eliminare = rowparent.parent();
                    box_da_eliminare.remove();
                });
            }
        </script>

    </body>

</html>