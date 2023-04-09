<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MusicNews</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <!--<link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" /> -->
    <link rel="stylesheet" href="da_merge.css" />
    <link rel="stylesheet" href="stili.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="https://www.flaticon.com/free-icons/sound-waves" title="sound waves icons">
    <script src="https://kit.fontawesome.com/d20fe07ffa.js" crossorigin="anonymous"></script>
    <script src="da_merge.js" defer></script>
</head>

<body class="bg-light">
    <!--NAVBAR-->
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
                <a class="my_navbar_login" style="color: black; opacity: 100%" href="#" onclick="see_or_unsee_form();"
                    value="Login"><i class="fa-solid fa-user-plus icona_utente" aria-hidden="false"
                        aria-valuetext="Accedi Ora"></i></a>
            </nav>
            <div class="form_popup">
                <?php if (!isset($_SESSION["loggedinusers"]) || $_SESSION["loggedinusers"] != true) {
                    echo "
                <form action=\"./login/login.php\" method=\"POST\" class=\"form-container\" id=\"my_form\">
                    <h1 class=\"my_h1\">Login</h1>
                    <label for=\"email\"><b>Email</b></label>
                    <input type=\"text\" placeholder=\"Enter Email\" name=\"inputEmail\" required />

                    <label for=\"psw\"><b>Password</b></label>
                    <input type=\"password\" placeholder=\"Enter Password\" name=\"inputPassword\" required />

                    <button type=\"submit\" class=\"btn\">Login</button>
                    <p class=\"messaggio\">
                        Not registered? <a href=\"login.html\">Create an account</a>
                    </p>
                    <p class=\"messaggio\">
                        Password Forgotten? <a href=\"#\">Click here</a>
                    </p>
                </form>";
                } else {
                    echo "<form action=\"./no-login/no-login.php\" method=\"POST\" class=\"form-container\" id=\"my_form\">
                    <button type=\"submit\" class=\"btn\">Log Out</button>
                  </form>";
                }
                ?>
            </div>
        </div>
    </header>
    <!--FINE NAVBAR-->

    <!--TITOLO-->
    <div class=" header_page header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="
      min-height: 500px;
      background-image: url(./images/HeaderHomepage.jpg);
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
                    <h1 class="display-3 text-white">Music News</h1>
                    <p class="text-white mt-0 mb-5">
                        A music blog for everyone
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!--SEZIONE CAROSELLI-->
    <section class="section d-flex " aria-describedby="titleEx1" style="margin-top: 20px;">
        <div class="section-content">
            <div class="row d-flex flex-wrap mb-3 no-gutters">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <div class="row">
                        <h2 id="titleEx1" class="most_recent_top_g">WHAT'S NEW?</h2>
                    </div>
                    <div class="row">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus velit
                            temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur, quibusdam at,
                            animi minima suscipit optio exercitationem error?</p>
                    </div>
                    <div class="row">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus velit
                            temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur, quibusdam at,
                            animi minima suscipit optio exercitationem error?</p>
                    </div>
                    <div class="row">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus velit
                            temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur, quibusdam at,
                            animi minima suscipit optio exercitationem error?</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="container-fluid">
                        <!--BOOTSTRAP CAROUSEL-->
                        <div id="carosello" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carosello" data-slide-to="0" class="active"></li>
                                <li data-target="#carosello" data-slide-to="1"></li>
                                <li data-target="#carosello" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner ">
                                <div class="carousel-item active">
                                    <!--CONTAINER DELLE CARTE-->
                                    <div class="container d-block bg-light">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <!--CARD-->
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_left_g" id="img-card-0"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-0"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-0">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_right_g" id="imh-card-1"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a id="title-card-1" class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-1">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_left_top_g" id="img-card-2"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-2"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-2">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_right_top_g" id="img-card-3"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-3"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-3">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!--CONTAINER DELLE CARTE-->
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <!--CARD-->
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_left_g" id="img-card-4"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a id="title-card-4" class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-4">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_right_g" id="img-card-5"
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATYAAACjCAMAAAA3vsLfAAAAflBMVEUAAADPEQDXEgDYEgDREQDKEQFhCAA0BQO7DwAxBQLUEQBnCQNgCAPCEAHJEQGGCwJEBgGtDgE6BQG/EAFUBwGQDAJrCQJYBwGbDQK1DwEuBAF6CgGACwGLDAJTBwFJBgESAQFxCQEpBAGpDgE/BgIlAwGYDQIaAgEhAwEnBAKIBwZUAAAFdUlEQVR4nO2bjW7qOBCFiW1a6hIoUAoUaC9tl+2+/wtuQn6wx5PgaDcJjs53dVUBScQcHdvjGTMaAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMAdspBCyBKR/JPFayGy1+X/9KXI/5SfCBm/9x1E5+xF9J/R331H0TmH/0E2teg7iu6J0wFH0FpVCKS1e7VUL30H0QOPlOXP9DARnHB6tn5+WTo39B3BHTGNXN30oe9vdf88OrKJt76/UwgcNZnXdn1/oyB4Imushtm8GJMxuuz7C4XB2J7dxJPx2XL6tvmrt29211TLdpyJNIHbwX8MVbJ9Rnk2rMTU60Ef8/V6fXwoX28rkukr5xbC6Qo6t+WyLa9bCCV+bj/mM06smSCifE3ZyPzuatnkR3thtU2FbBMjXLW6+ZRpud9Qcn555+32Nlg8txlYu/CDdCMaxfduZn9ykz04s1+B6zo1bjm0NuFl21pZsIpvPGRnPkRNsjenJm8zdz9yajeyVuEH6UQ1idD2ZiS/mGv+kO1IpGYtRNMZvGzNQiQi6wfuogWxW8gzW9UgpQNK19ltQzdorGxklHqsM/eMn2y1diNm42V7INrmC0eoeA3S2iocNRsvG9E29EqLp2w12QI1GyvbpyRm+2wroG7wG6Q1dnuVzqWMbGRBCL6f4ytbFFU8wDEbJ9uSDGQRuNn8ZdNH9v5XdxPFyGanz8HPbE3cptn7d0wTx5Htl+S6IuxldOS9JKRqrJnbGbMxsq2J2W5t1u4ff7dF+m/3dsZsjGzkgqB3oxn+bou0W1fkzObKdiBmC7n0kdPAbZF2Gguc2VzZyL5Kz7sIrF0aybYlN7Nmc2SjFUvVTWSt0kS2SJAzbm7OxskWE7NxS0toNJjbEp/YZ9ymfOGbyOYUSP7pLLj2aOQ20n2OWbNR2cj8pwZxvLCR2+y95HNFl8WW7YVu4gfRd62VTSWZg508mPl9tkCml9RVd78HtonPqBukapbsuE9V3ZiTKDRa2hmGJdsXMZt47TjAdqiTTV8WzpPd/Ntbd2bH4aaWtJZsZ5Lqhl0LL6mRTeVp2sq6pMi69qkeeSnjt1I22rAKu/FypWZu07mx7MpskfNejimI/DyC9QxTNnLsMOwun0GdbIUz7NJsdnRjbpiNeNaUjZwB0fvRMKgZpKVstDb7mB6tiQyz2eIbsu1pU7nb4NrDRzZ6tkGt5xcXXYu0VbLRfRVfIQ4Qn0HqVGd19ro0W5VsNCHmKnZh4uU2Wp7NXXfNXCtko6ccaAUlXLzcxu+2jF4nvyR80H7VcH5KU+E2RWQ7uHYzt0m822hzdBCb+Ay/QepcZ5uNl+2Fmm1AP3bzle1Eyx1Wr5MdpNRswTdHDTznNre4ZjXWrU9y2X6o2fxOnIeBt2zkpJXtHc5t1GwD6Fdd8ZaNZBP2RMW47YdUjNRwso+R/9yWpBOmDqTayCwJpDxJnxY4/rJZTQGyKjKy0SVkQEnbqJFsxrCjpW1XthNN9GizMGxIx1xkh+P5YXUddzQFs8S/LJnOT64G0R4tscMrWgW8bE+Fg5w+ilUAlmkjlDktOKRf+JLSbX48g5etLCA5+b651c+kXzmyRSLeno9zm2BPVW6diEeVsuUFJHdz+WU8JGvS0IX0cp/SFBnshmtXhqzGxZGiy4zHpPXHy/rIdIj3pWl19pOrZ+ckNEvAhcuzVCq1gtiVVcSDVJHm2iU7rZTkGgJ7kXySIIqO3lbq7J1aJPuLmTBYbmMtZwszgsMsWvxy127HMT+1v59XcRzvrpI+Hs7fu0k9qwEcdQMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMkX8Bv0I8Y6bqMTkAAAAASUVORK5CYII="
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-5">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_left_top_g" id="img-card-6"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g"
                                                        id="title-card-6">
                                                        <a class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-6">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_right_top_g" id="img-card-7"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a id="title-card-7" class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-7">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <!--CONTAINER DELLE CARTE-->
                                    <div class="container">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <!--CARD-->
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_left_g" id="img-card-8"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a id="title-card-8" class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-8">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_top_right_g" id="img-card-9"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a id="title-card-9" class="h5"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-9">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_left_top_g" id="img-card-10"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-10"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-10">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card bg-light text-white card_top_g">
                                                    <img class="card-img card_bottom_right_top_g" id="img-card-11"
                                                        src="data:image/png;base64,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"
                                                        alt="Card image" />
                                                    <div class="card-img-overlay card_paragraph_top_g">
                                                        <a class="h5" id="title-card-11"
                                                            href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                                        TMZ TITLE
                                                        </a>
                                                        <p class="card-text font-italic text_in_card_top_g"
                                                            id="text-card-11">
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                                            Sed magni cum accusamus velit temporibus veniam quidem
                                                            maxime ratione quae obcaecati vero consequuntur, quibusdam
                                                            at, animi minima suscipit optio exercitationem error?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Fine carosello-->
                            <a class="carousel-control-prev" href="#carosello" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carosello" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--FINE PRIMO CAROSELLO-->
    <hr>
    <div class="row d-flex flex-wrap mb-3 no-gutters">
        <div class="col-md-6">
            <h2 class="most_recent_top_g">NEW STORIES</h2>
            <div class="scene_top_g">
                <div class="carousel_top_g">
                    <div class="carousel__cell_top_g">
                        <!--IMMAGINI-->
                        <div class=" card card_cube_top_g">
                            <img class="img_cube_top_g card-img" id="img-cube-0"
                                src="data:image/png;base64,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"
                                alt="Card image" />
                            <div class="card-img-overlay text-white">
                                <a class="h3" id="title-cube-0"
                                    href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                TMZ TITLE
                                </a>
                                <p class="card-text font-italic card_cube_text_top_g" id="text-cube-0">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus
                                    velit temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur,
                                    quibusdam at, animi minima suscipit optio exercitationem error?
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel__cell_top_g">
                        <div class=" card card_cube_top_g">
                            <img class="img_cube_top_g card-img" id="img-cube-1"
                                src="data:image/png;base64,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"
                                alt="Card image" />
                            <div class="card-img-overlay text-white">
                                <a id="title-cube-1" class="h3"
                                    href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                TMZ TITLE
                                </a>
                                <p class="card-text font-italic card_cube_text_top_g" id="text-cube-1">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus
                                    velit temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur,
                                    quibusdam at, animi minima suscipit optio exercitationem error?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel__cell_top_g">
                        <div class=" card card_cube_top_g">
                            <img class="img_cube_top_g card-img" id="img-cube-2"
                                src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATYAAACjCAMAAAA3vsLfAAAAflBMVEUAAADPEQDXEgDYEgDREQDKEQFhCAA0BQO7DwAxBQLUEQBnCQNgCAPCEAHJEQGGCwJEBgGtDgE6BQG/EAFUBwGQDAJrCQJYBwGbDQK1DwEuBAF6CgGACwGLDAJTBwFJBgESAQFxCQEpBAGpDgE/BgIlAwGYDQIaAgEhAwEnBAKIBwZUAAAFdUlEQVR4nO2bjW7qOBCFiW1a6hIoUAoUaC9tl+2+/wtuQn6wx5PgaDcJjs53dVUBScQcHdvjGTMaAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMAdspBCyBKR/JPFayGy1+X/9KXI/5SfCBm/9x1E5+xF9J/R331H0TmH/0E2teg7iu6J0wFH0FpVCKS1e7VUL30H0QOPlOXP9DARnHB6tn5+WTo39B3BHTGNXN30oe9vdf88OrKJt76/UwgcNZnXdn1/oyB4Imushtm8GJMxuuz7C4XB2J7dxJPx2XL6tvmrt29211TLdpyJNIHbwX8MVbJ9Rnk2rMTU60Ef8/V6fXwoX28rkukr5xbC6Qo6t+WyLa9bCCV+bj/mM06smSCifE3ZyPzuatnkR3thtU2FbBMjXLW6+ZRpud9Qcn555+32Nlg8txlYu/CDdCMaxfduZn9ykz04s1+B6zo1bjm0NuFl21pZsIpvPGRnPkRNsjenJm8zdz9yajeyVuEH6UQ1idD2ZiS/mGv+kO1IpGYtRNMZvGzNQiQi6wfuogWxW8gzW9UgpQNK19ltQzdorGxklHqsM/eMn2y1diNm42V7INrmC0eoeA3S2iocNRsvG9E29EqLp2w12QI1GyvbpyRm+2wroG7wG6Q1dnuVzqWMbGRBCL6f4ytbFFU8wDEbJ9uSDGQRuNn8ZdNH9v5XdxPFyGanz8HPbE3cptn7d0wTx5Htl+S6IuxldOS9JKRqrJnbGbMxsq2J2W5t1u4ff7dF+m/3dsZsjGzkgqB3oxn+bou0W1fkzObKdiBmC7n0kdPAbZF2Gguc2VzZyL5Kz7sIrF0aybYlN7Nmc2SjFUvVTWSt0kS2SJAzbm7OxskWE7NxS0toNJjbEp/YZ9ymfOGbyOYUSP7pLLj2aOQ20n2OWbNR2cj8pwZxvLCR2+y95HNFl8WW7YVu4gfRd62VTSWZg508mPl9tkCml9RVd78HtonPqBukapbsuE9V3ZiTKDRa2hmGJdsXMZt47TjAdqiTTV8WzpPd/Ntbd2bH4aaWtJZsZ5Lqhl0LL6mRTeVp2sq6pMi69qkeeSnjt1I22rAKu/FypWZu07mx7MpskfNejimI/DyC9QxTNnLsMOwun0GdbIUz7NJsdnRjbpiNeNaUjZwB0fvRMKgZpKVstDb7mB6tiQyz2eIbsu1pU7nb4NrDRzZ6tkGt5xcXXYu0VbLRfRVfIQ4Qn0HqVGd19ro0W5VsNCHmKnZh4uU2Wp7NXXfNXCtko6ccaAUlXLzcxu+2jF4nvyR80H7VcH5KU+E2RWQ7uHYzt0m822hzdBCb+Ay/QepcZ5uNl+2Fmm1AP3bzle1Eyx1Wr5MdpNRswTdHDTznNre4ZjXWrU9y2X6o2fxOnIeBt2zkpJXtHc5t1GwD6Fdd8ZaNZBP2RMW47YdUjNRwso+R/9yWpBOmDqTayCwJpDxJnxY4/rJZTQGyKjKy0SVkQEnbqJFsxrCjpW1XthNN9GizMGxIx1xkh+P5YXUddzQFs8S/LJnOT64G0R4tscMrWgW8bE+Fg5w+ilUAlmkjlDktOKRf+JLSbX48g5etLCA5+b651c+kXzmyRSLeno9zm2BPVW6diEeVsuUFJHdz+WU8JGvS0IX0cp/SFBnshmtXhqzGxZGiy4zHpPXHy/rIdIj3pWl19pOrZ+ckNEvAhcuzVCq1gtiVVcSDVJHm2iU7rZTkGgJ7kXySIIqO3lbq7J1aJPuLmTBYbmMtZwszgsMsWvxy127HMT+1v59XcRzvrpI+Hs7fu0k9qwEcdQMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMkX8Bv0I8Y6bqMTkAAAAASUVORK5CYII="
                                alt="Card image" />
                            <div class="card-img-overlay text-white">
                                <a class="h3" id="title-cube-2"
                                    href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                TMZ TITLE
                                </a>
                                <p class="card-text font-italic card_cube_text_top_g" id="text-cube-2">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus
                                    velit temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur,
                                    quibusdam at, animi minima suscipit optio exercitationem error?
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel__cell_top_g">
                        <div class=" card card_cube_top_g">
                            <img class="img_cube_top_g card-img" id="img-cube-3"
                                src="data:image/png;base64,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"
                                alt="Card image" />
                            <div class="card-img-overlay text-white">
                                <a class="h3" id="title-cube-3"
                                    href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiAuuy1zv_9AhUahP0HHXP-BqcQFnoECA4QAQ&url=https%3A%2F%2Fwww.tmz.com%2F&usg=AOvVaw0QIdwyeMkyrNPrxkpccs0F" />
                                TMZ TITLE
                                </a>
                                <p class="card-text font-italic card_cube_text_top_g" id="text-cube-3">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sed magni cum accusamus
                                    velit temporibus veniam quidem maxime ratione quae obcaecati vero consequuntur,
                                    quibusdam at, animi minima suscipit optio exercitationem error?
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="next" class="next"><ion-icon name="caret-back-circle-outline"></ion-icon></div>
                    <div id="prev" class="prev"><ion-icon name="caret-forward-circle-outline"></ion-icon></div>
                </div>
            </div>
            <div class="h2 header_center_top_g">
                YOUR PASSION SPEAKS TO US
            </div>
            <div>
                <img src="da_merge_img/img-5.jpg" class="img_center_top_g">
            </div>
        </div>
        <div class="col-md-6">
            <h2 class="most_recent_top_g ">LATEST STORIES</h2>
            <article class="bottom_division_top_g">
                <h3>NEWS</h3>
                <p>Welcome to MusicNews, where you're getting only the hottest news about
                    popstars and singers from all over the world! Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Architecto consectetur eaque quidem? Officiis labore illum deleniti expedita fugiat animi cum,
                    modi, vero suscipit veniam dolore, natus odit itaque eum officia.</p>
                <a href="#"> Read More</a>
            </article>
            <article class="bottom_division_top_g">
                <h3>NEWS</h3>
                <p>Welcome to MusicNews, where you're getting only the hottest news about
                    popstars and singers from all over the world! Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Architecto consectetur eaque quidem? Officiis labore illum deleniti expedita fugiat animi cum,
                    modi, vero suscipit veniam dolore, natus odit itaque eum officia.</p>
                <a href="#"> Read More</a>
            </article>
            <article class="bottom_division_top_g">
                <h3>NEWS</h3>
                <p>Welcome to MusicNews, where you're getting only the hottest news about
                    popstars and singers from all over the world! Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Architecto consectetur eaque quidem? Officiis labore illum deleniti expedita fugiat animi cum,
                    modi, vero suscipit veniam dolore, natus odit itaque eum officia.</p>
                <a href="#"> Read More</a>
            </article>
            <article>
                <h3>NEWS</h3>
                <p>Welcome to MusicNews, where you're getting only the hottest news about
                    popstars and singers from all over the world! Lorem ipsum dolor sit amet consectetur adipisicing
                    elit. Architecto consectetur eaque quidem? Officiis labore illum deleniti expedita fugiat animi cum,
                    modi, vero suscipit veniam dolore, natus odit itaque eum officia.</p>
                <a href="#"> Read More</a>
            </article>
        </div>
    </div>
    </hr>
    <!--SECONDO CAROSELLO-->





    <!--FINE SEZIONE CAROSELLI-->

    <!--INIZIO FOOTER-->
    <footer class="footer_top_g">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>About Us</h4>
                    <p> On MusicNews™ you're getting only the most interesting and relevant news on the world's most
                        famous
                        popstars and singers! </p>
                </div>
                <div class="col-md-3">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i>1234 Street Name, City Name, Country</li>
                        <li><i class="fas fa-envelope"></i>info@domain.com</li>
                        <li><i class="fas fa-phone"></i>+1 234 567 890</li>
                    </ul>
                </div>
            </div>
            <div class="d-flex footer_imgs_bg_top_g row justify-content-lg-between">
                <img src="da_merge_img/music-homepage-0.jpg" class="footer_img_top_g">
                <img src="da_merge_img/music-homepage-1.jpg" class="footer_img_top_g">
                <img src="da_merge_img/music-homepage-2.jpg" class="footer_img_top_g">
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <ul class="social_icon_top_g">
                        <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
                        <li><a href="#"><ion-icon name="home-outline"></ion-icon></a></li>
                    </ul>
                    <p class="text-light all_rights_reserved_top_g">© 2023 MusicNews | All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./metodi.js"></script>
</body>

</html>