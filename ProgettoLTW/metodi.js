var userIcon = document.querySelector(".my_navbar_login");
var navbarMenu = document.getElementById("bottone_toggle");
var listaNavbar = document.getElementById("lista_navbar");
var bottoneRicerca = document.getElementById("bottone_ricerca");
var searchInput = document.getElementById("Search_input");
var popup = document.getElementById("my_form");
// aggiungi un gestore di eventi di clic al pulsante della navbar
searchInput.style.width = "0";
navbarMenu.addEventListener("click", () => {
  // controlla se il menu della navbar è aperto
  if (navbarMenu.value == "NOT clicked") {
    // se sì, rimuovi l'icona dell'utente dalla navbar
    userIcon.style.display = "none";
    navbarMenu.value = "clicked";
    // crea un nuovo elemento della navbar per il login
    const loginItem = document.createElement("li");
    loginItem.classList.add("nav-item", "my_nav-item");
    loginItem.innerHTML = '<a class="nav-link" href="#">Login</a>';
    // inserisci il nuovo elemento nella navbar
    listaNavbar.append(loginItem);
  } else {
    // se il menu della navbar è chiuso, ripristina l'icona dell'utente e rimuovi l'elemento del login
    navbarMenu.value = "NOT clicked";
    var loginItem = listaNavbar.lastChild;
    if (loginItem.innerText === "Login") {
      listaNavbar.removeChild(loginItem);
    }
    setTimeout(() => {
      userIcon.style.display = "block";
    }, 400);
  }
});

// Aggiungiamo un event listener al bottone di ricerca
bottoneRicerca.addEventListener("mouseenter", () => {
  // All'avvicinamento del mouse, ingrandiamo l'input
  searchInput.style.width = "200px";
  searchInput.style.caretColor = "auto";
});

// Aggiungiamo un event listener all'input
searchInput.addEventListener("mouseleave", () => {
  // Quando il mouse esce dall'input, riduciamo la sua larghezza
  searchInput.style.width = "0";
  searchInput.style.caretColor = "transparent";
});
function see_or_unsee_form() {
  console.log("ci sono qua");
  if (popup.classList.contains("visible")) {
    popup.classList.remove("visible");
  } else {
    popup.classList.add("visible");
  }
}
