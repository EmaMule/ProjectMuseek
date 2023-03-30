var userIcon = document.querySelector('.my_navbar_login');
var navbarMenu = document.getElementById("bottone_toggle");
var listaNavbar=document.getElementById("lista_navbar");
// aggiungi un gestore di eventi di clic al pulsante della navbar
navbarMenu.addEventListener('click', () => {
  // controlla se il menu della navbar è aperto
  if (navbarMenu.value=="NOT clicked") {
    // se sì, rimuovi l'icona dell'utente dalla navbar
    userIcon.style.display = 'none';
    navbarMenu.value="clicked";
    // crea un nuovo elemento della navbar per il login
    const loginItem = document.createElement('li');
    loginItem.classList.add('nav-item', 'my_nav-item');
    loginItem.innerHTML = '<a class="nav-link" href="#">Login</a>';
    // inserisci il nuovo elemento nella navbar
    listaNavbar.append(loginItem);
  } else {
    // se il menu della navbar è chiuso, ripristina l'icona dell'utente e rimuovi l'elemento del login
    navbarMenu.value="NOT clicked";
    var loginItem = listaNavbar.lastChild;
    if(loginItem.innerText==="Login"){
    listaNavbar.removeChild(loginItem);
    }
    setTimeout(()=>{
        userIcon.style.display = 'block';},400);
    }
});

function see_or_unsee_form() {
    var popup = document.getElementById("my_form");
    if (popup.classList.contains("visible")) {
        popup.classList.remove("visible");
    } else {
        popup.classList.add("visible");
    }
  }