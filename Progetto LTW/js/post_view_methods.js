$(document).ready(function () {
  $(".form-commento").submit(function (event) {
    var text = $("#comment-text").val();
    event.preventDefault();
    var utente = "<?php echo $utente; ?>";
    var id = "<?php echo $id; ?>";
    jQuery
      .ajax({
        url: "../php-function/upload_comment.php",
        type: "post",
        data: {
          testo: text,
          utente: "<?php echo $utente; ?>",
          id: "<?php echo $id ?>",
        },
      })
      .done(function (result) {
        //creiamo il commento al volo e lo appendiamo in cima alla lista
        result = JSON.parse(result);
        const text = result[0];
        const username = result[1];
        const data = result[2];
        const ora = result[3];
        const foto = result[4];
        const id_com = result[5];

        const box_commento = document.createElement("li");
        box_commento.classList.add("container");
        box_commento.classList.add("commento-container");
        const img = document.createElement("img");
        img.src = "data:image/jpeg;charset=utf8;base64," + foto;
        img.classList.add("commento-img");
        const name = document.createElement("header");
        name.classList.add("commento-username");
        const row = document.createElement("div");
        row.classList.add("row");
        const row2 = document.createElement("div");
        row2.classList.add("row");
        const row3 = document.createElement("div");
        row3.classList.add("row");

        //creiamo gli elementi di testo veri e propri dalle stringhe
        const textnode = document.createTextNode(text);
        const usernametextnode = document.createTextNode(username);
        name.appendChild(usernametextnode);
        const dataNode = document.createTextNode(data);
        const oraNode = document.createTextNode("  " + ora);

        box_commento.appendChild(row);
        row.appendChild(img);
        row.appendChild(name);
        box_commento.appendChild(row2);
        row2.appendChild(textnode);
        box_commento.appendChild(row3);
        row3.appendChild(dataNode);
        row3.appendChild(oraNode);
        row3.classList.add("commento-3rd-row");

        //creiamo il delete button
        const row4 = document.createElement("div");
        row4.classList.add("row");
        const btn = document.createElement("button");
        btn.classList.add("btn");
        btn.classList.add("btn-danger");
        btn.setAttribute("id", id_com);
        btn.addEventListener("click", function (e) {
          cancellaCommento(e);
        });
        btn.innerText = "X";
        row4.appendChild(btn);
        box_commento.appendChild(row4);

        //infine inseriamo il commento all'inizio
        document
          .getElementById("list-comments")
          .insertBefore(
            box_commento,
            document.getElementById("list-comments").firstChild
          );
      });
  });
});

//Script per altri commenti
