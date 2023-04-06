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
const loginButton = document.getElementById("btn-login");
const loginForm = document.getElementById("login-form");
const registerButton = document.getElementById("btn-register");
const registerForm = document.getElementById("register-form");
loginButton.addEventListener("click", () => {
  console.log("ok qua è partito");
  console.log(loginForm);
  window.scrollIntoView({ behavior: "smooth", block: "center" });
});
registerButton.addEventListener("click", () => {
  console.log("ok qua è partito");
  console.log(loginForm);
  window.scrollIntoView({ behavior: "smooth", block: "center" });
});
