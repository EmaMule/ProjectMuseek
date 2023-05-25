<?php session_start();
if (!isset($_SESSION["loggedinusers"]) || $_SESSION["loggedinusers"] != true) {
  header("Location: login.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/stili.css" />
  <link rel="stylesheet" href="../css/post.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
  <title>Create a Post</title>
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
        background-image: url(../images/WallpaperDog-20353053.jpg);
        background-size: cover;
        background-position: center;
      ">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
          <h1 class="display-3 text-white" style="font-weight:500;">Create a new article</h1>
          <p class="text-white mt-0 mb-5">
            This is where you can post your articles. Create a new post to
            share the latest news about music on the internet.
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="p-3 d-flex justify-content-center container-fluid articolo">
    <div class="col-xl-8">
      <div class="card bg-secondary shadow colonna">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Create Article</h3>
            </div>
          </div>
        </div>
        <div class="card-body carta">
          <form method="POST" action="../php-pagine/post_confirm.php" enctype="multipart/form-data">
            <h6 class="heading-small mb-4">Describe your article</h6>
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="input-title">Title</label>
                    <input type="text" id="input-title" name="inputTitle" class="form-control form-control-alternative"
                      placeholder="Title" required value="" />
                  </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-center">
                  <div class="drop-zone">
                    <span class="drop-zone__prompt">Drop your img here or click to upload</span>
                    <input type="file" required id="myFile" name="inputImage" class="drop-zone__input"
                      accept=".jpeg, .jpg, .png" maxlength="2M" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="input-description">Description</label>
                    <textarea id="input-description no-resize" style="resize: none;" name="inputDescription"
                      class="form-control form-control-alternative" rows="10" placeholder="Insert Description" value=""
                      required></textarea>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4" />
            <h6 class="mb-2">Add sources</h3>
              <div id="input-container"></div>
              <button class="btn-success btn" id="add-input-button" type="button">
                +
              </button>
              <button class="btn-danger btn" id="remove-input-button" type="button" style="display: none">
                -
              </button>
              <hr class="my-4" />
              <div class="container-fluid">
                <button type="submit" class="btn btn-outline-success float-right">
                  Create Article
                </button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <script src="../js/metodi.js"></script>
  <script src="../js/post.js"></script>
</body>

</html>