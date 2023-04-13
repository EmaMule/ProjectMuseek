function mostranascondi() {
  var form = document.querySelector(".login-box");
  form.style.display = "none";
  var passwords = document.querySelectorAll(".fa-lock");
  passwords.forEach((falock) => {
    falock.addEventListener("click", () => {
      let password = falock.parentElement.querySelectorAll(".password");
      password.forEach((password) => {
        if (password.type == "password") {
          password.type = "text";
          return;
        } else {
          password.type = "password";
        }
      });
    });
  });
}

function mostraLogin() {
  var form_log = document.querySelector(".login-box");
  var form_sign = document.querySelector(".signup-box");

  form_log.style.display = "flex";
  form_sign.style.display = "none";
}
function mostraRegister() {
  var form_log = document.querySelector(".login-box");
  var form_sign = document.querySelector(".signup-box");
  form_log.style.display = "none";
  form_sign.style.display = "flex";
}
const LoginForm = document.querySelector("#LoginForm");
const RegisterForm = document.querySelector("#RegisterForm");

LoginForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const formData = new FormData(LoginForm);
  const response = await fetch("../php-function/login.php", {
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
      window.location.href = "../php-pagine/YourProfile.php";
    }
  } else {
    // la città o il paese inserito non esiste
    alert("ERROR RESPONSE");
  }
});
RegisterForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  if (
    document.getElementById("password").value !==
    document.getElementById("confirm-password").value
  ) {
    alert("PASSWORD NON CONINCIDONO");
    return;
  }
  const formData = new FormData(RegisterForm);
  const response = await fetch("../php-function/register.php", {
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
      window.location.href = "../php-pagine/YourProfile.php";
    }
  } else {
    // la città o il paese inserito non esiste
    alert("ERROR RESPONSE");
  }
});
