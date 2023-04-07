var userIcon = document.querySelector(".my_navbar_login");
var navbarMenu = document.getElementById("bottone_toggle");
var listaNavbar = document.getElementById("lista_navbar");
var bottoneRicerca = document.getElementById("bottone_ricerca");
var searchInput = document.getElementById("Search_input");
var popup = document.getElementById("my_form");
var searchBar = document.getElementById("search_bar");
var form_see_unsee = document.querySelector(".form_popup");
console.log(form_see_unsee);
// aggiungi un gestore di eventi di clic al pulsante della navbar
searchInput.style.width = "0";
navbarMenu.addEventListener("click", () => {
  // controlla se il menu della navbar è aperto
  if (navbarMenu.value == "NOT clicked") {
    // se sì, rimuovi l'icona dell'utente dalla navbar
    userIcon.style.display = "none";
    searchBar.style.display = "none";
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
      searchBar.style.display = "initial";
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
popup.addEventListener("mouseleave", () => {
  popup.classList.remove("visible");
  form_see_unsee.classList.remove("form_visible");
  disableFormInputs();
  disableFormAnchors();
});
function see_or_unsee_form() {
  if (popup.classList.contains("visible")) {
    return false;
  } else {
    popup.classList.add("visible");
    form_see_unsee.classList.add("form_visible");
    enableFormInputs();
    enableFormAnchors();
  }
}
function enableFormInputs() {
  const formInputs = popup.querySelectorAll("input, textarea, button");
  formInputs.forEach((input) => {
    input.disabled = false;
  });
}
function disableFormInputs() {
  const formInputs = popup.querySelectorAll("input, textarea, button");
  formInputs.forEach((input) => {
    input.disabled = true;
  });
}
function disableFormAnchors() {
  const formAnchors = popup.querySelectorAll("a");
  formAnchors.forEach((anchor) => {
    anchor.style.cursor = "default";
  });
}

function enableFormAnchors() {
  const formAnchors = popup.querySelectorAll("a");
  formAnchors.forEach((anchor) => {
    if (anchor.style.cursor == "default") {
      anchor.style.cursor = "pointer";
    }
  });
}
