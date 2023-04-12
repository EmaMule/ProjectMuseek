var userIcon = document.querySelector(".my_navbar_login");
var navbarMenu = document.getElementById("bottone_toggle");
var listaNavbar = document.getElementById("lista_navbar");
var bottoneRicerca = document.getElementById("bottone_ricerca");
var searchInput = document.getElementById("Search_input");
var popup = document.getElementById("my_form");
var searchBar = document.getElementById("search_bar");
var form_see_unsee = document.querySelector(".form_popup");
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
  if (searchInput.value.trim() === "") {
    searchInput.style.width = "0";
    searchInput.style.caretColor = "transparent";
  }
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
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("search_results").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var results = JSON.parse(this.responseText);
        showResults(results);
      }
    };
    xmlhttp.open("GET", "gethint.php?q=" + str, true);
    xmlhttp.send();
  }
}

function showResults(results) {
  var output = "";
  output = "<ul id='mioid'>";
  if (results.length > 0) {
    for (var i = 0; i < results.length; i++) {
      output +=
        "<li><img class='img_searchbar' src='data:image/jpg;charset=utf8;base64," +
        results[i]["immagine"] +
        "'><span class='titolo_searchbar'><a href='./post/post_view.php?article=" +
        results[i]["id"] +
        "'>" +
        results[i]["titolo"] +
        "</a></span></li>";
    }
    output += "</ul>";
  } else {
    output += "<li> No result </li> </ul>";
  }
  document.getElementById("search_results").innerHTML = output;
}
const elemento2 = document.getElementById("search_results");
searchInput.addEventListener("mouseenter", () => {
  elemento2.style.display = "block";
});
searchInput.addEventListener("mouseleave", () => {
  if (searchInput.value.trim() === "") {
    elemento2.innerHTML = "";
  }
});
var LoginFormEma = document.getElementsByName("login_ema");
var LogoutFormEma = document.getElementsByName("logout_ema");
if (LoginFormEma.length != 0) {
  LoginFormEma = LoginFormEma[0];
  LoginFormEma.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(LoginFormEma);
    const response = await fetch("./login/login.php", {
      method: "POST",
      body: formData,
    });
    if (response.ok) {
      const data = await response.json(); // ottieni il contenuto della risposta come oggetto JSON
      if (data.error) {
        // gestisci l'errore
        alert("Error: " + data.error);
      } else {
        // la risposta non contiene errori, esegui altre operazioni
        window.location.href = "YourProfile.php";
      }
    } else {
      // la città o il paese inserito non esiste
      alert("ERROR RESPONSE");
    }
  });
} else {
  LogoutFormEma = LogoutFormEma[0];
  LogoutFormEma.addEventListener("submit", async (event) => {
    event.preventDefault();
    const formData = new FormData(LogoutFormEma);
    const response = await fetch("./no-login/no-login.php", {
      method: "POST",
      body: formData,
    });
    if (response.ok) {
      const data = await response.json();
      console.log(data); // ottieni il contenuto della risposta come oggetto JSON
      if (data.error) {
        // gestisci l'errore
        alert("Error: " + data.error);
      } else {
        // la risposta non contiene errori, esegui altre operazioni
        window.location.href = "YourProfile.php";
      }
    } else {
      // la città o il paese inserito non esiste
      alert("ERROR RESPONSE");
    }
  });
}
