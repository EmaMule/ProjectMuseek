function see_or_unsee_form() {
    var popup = document.getElementById("my_form");
    if (popup.classList.contains("visible")) {
        document.getElementById("bottone_login").value="CLOSE";
        popup.classList.remove("visible");
    } else {
        document.getElementById("bottone_login").value="CLOSE";
        popup.classList.add("visible");
    }
  }