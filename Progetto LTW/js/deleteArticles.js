$(document).ready(function () {
  $(".delete-clickable").click(function (event) {
    event.preventDefault();
    const id = this.id;
    if (confirm("Are you sure you want to delete your article?")) {
      jQuery
        .ajax({
          url: "../php-function/deleteArticles.php",
          type: "post",
          data: { id: id },
        })
        .done(function (result) {
          if (result == "SUCCESS") {
            //Facciamo il reload per ricostruire correttamente la pagina senza l'articolo
            location.reload();
          } else {
            alert(result);
          }
        });
    }
  });
});
