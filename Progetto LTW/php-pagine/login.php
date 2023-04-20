<?php session_start();
if (isset($_SESSION["loggedinusers"]) && $_SESSION["loggedinusers"] == true) {
  header("Location: ./YourProfile.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../bootstrap-4.0.0/dist/css/bootstrap.min.css" />
  <!-- Questa mi è servita per le icone-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
  <!-- Stylesheet -->
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="stylesheet" href="../css/stili.css" />
</head>

<body onload="mostranascondi();">
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
          <button id="bottone_ricerca">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <a class="my_navbar_login" style="color: black; opacity: 100%" href="javascript:void(0);"
          onclick="see_or_unsee_form();" value="Login"> <?php if (isset($_SESSION["loggedinusers"]) && $_SESSION["loggedinusers"] == true) {
            echo "<img class='immagine-profilo' src='data:image/jpg;charset=utf8;base64," . $_SESSION['foto_profilo'] . "'>";
          } else {
            echo "
                    <i class='fa-solid fa-user-plus icona_utente' aria-hidden='false'
                        aria-valuetext='Accedi Ora'></i>";
          } ?></a>
      </nav>
      <div class="form_popup">
        <form class="form-container" id="my_form" name="login_ema" action="../php-function/login.php" method="POST">
          <h1 class="my_h1">Login</h1>
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="inputEmail" required />

          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="inputPassword" required />
          <button type="submit" class="btn">Login</button>
          <p class="messaggio">
            Not registered? <a href="#">Create an account</a>
          </p>
          <p class="messaggio">
            Password Forgotten? <a href="#">Click here</a>
          </p>
        </form>
      </div>
    </div>
  </header>
  <div class="search-results d-flex" style="color: black;">
    <div id="search_results" class="d-flex"></div>
  </div>
  <section class="forms">
    <div class="signup-box">
      <form name="myForm" id="RegisterForm" action="../php-function/register.php" method="POST">
        <h1>Signup</h1>
        <div class="box">
          <i class="fa-solid fa-signature"></i>
          <input type="text" class="nome" name="inputName" required />
          <label>First Name</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-signature"></i>
          <input type="text" class="cognome" name="inputCognome" required />
          <label>Last Name</label>
        </div>
        <div class="box">
          <input type="date" class="date" name="inputDate" required />
          <label>Date of Birth</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-user"></i>
          <input type="text" class="cognome" name="inputUsername" required />
          <label>Username</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-envelope"></i>
          <input type="email" name="inputEmail" required />
          <label>Email</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-lock bx-hide"></i>
          <input id="password" type="password" class="password" name="inputPassword" required />
          <label>Password</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-lock bx-hide"></i>
          <input id="confirm-password" type="password" class="password" name="inputConfirmPassword" required />
          <label> Confirm Password</label>
        </div>
        <button class="register-button" type="submit" id="btn-register">
          Register
        </button>
        <div class="register-link">
          <p>
            You have an account?<a href="#" onclick="mostraLogin();">Login</a>
          </p>
        </div>
      </form>
    </div>
    <div class="form login-box">
      <form id="LoginForm" action="../php-function/login.php" method="POST">
        <h1>Login</h1>
        <div class="box">
          <i class="fa-solid fa-envelope"></i>
          <input type='email' name='inputEmail' required />

          <label>Email</label>
        </div>
        <div class="box">
          <i class="fa-solid fa-lock"></i>
          <input type='password' class='password' name='inputPassword' required />
          <label>Password</label>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" name="rememberMe" />Remember me</label>
          <a href="#">Forgot Password?</a>
        </div>
        <button class="register-button" type="submit" id="btn-login">
          Login
        </button>
        <div class="register-link">
          <p>
            Don't have an account?<a href="#" onclick="mostraRegister();">Register</a>
          </p>
        </div>
      </form>
    </div>
  </section>
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
  <script src="../js/login.js"></script>
</body>

</html>