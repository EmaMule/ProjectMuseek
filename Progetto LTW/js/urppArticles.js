function MostraArticoli(email_user) {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      // Qui inserisci il codice per caricare gli articoli dell'utente
      // Quando il caricamento è completo, chiama resolve() per indicare che la Promise è stata risolta correttamente
      // In caso di errore, chiama reject() con un messaggio di errore
      jQuery
        .ajax({
          url: "../php-function/get_user_articles.php",
          type: "post",
          data: "email=" + email_user,
        })
        .done(function (result) {
          result = JSON.parse(result);
          var i = 0;

          const tablerow1 = document.createElement("div");
          tablerow1.classList.add("row");
          const tablerow2 = document.createElement("div");
          tablerow2.classList.add("row");
          const tablerow3 = document.createElement("div");
          tablerow3.classList.add("row");
          while (result[i]) {
            const id = result[i]["id"];
            const titolo = result[i]["titolo"];
            const descrizione = result[i]["descrizione"];
            const data = result[i]["data"];
            const immagine = result[i]["media"];

            //COSTRUIAMO L'ARTICOLO IN TABELLA
            const td = document.createElement("div");
            td.classList.add("col-lg-4");
            td.classList.add("align-middle");
            td.classList.add("mt-3");
            const card = document.createElement("div");
            card.classList.add("card");
            td.appendChild(card);

            const img = document.createElement("img");
            img.classList.add("card-img-top");
            img.classList.add("article_imgs");
            img.classList.add("img-fluid");
            img.src = "data:image/jpeg;charset=utf8;base64," + immagine;
            const container_img = document.createElement("div");
            container_img.classList.add(
              "container-fluid",
              "container",
              "d-flex",
              "img-fluid"
            );
            container_img.appendChild(img);
            card.appendChild(container_img);

            const body = document.createElement("div");
            body.classList.add("card-body");
            card.appendChild(body);

            const container = document.createElement("div");
            container.classList.add(
              "container",
              "container-fluid",
              "container_testi"
            );
            const a = document.createElement("a");
            a.href = "./post_view.php?article=" + id;
            const title = document.createElement("h5");
            title.classList.add("card-title");
            title.appendChild(document.createTextNode(titolo));
            a.appendChild(title);
            container.appendChild(a);

            const desc = document.createElement("p");
            desc.classList.add("card-text");
            desc.appendChild(document.createTextNode(descrizione));
            container.appendChild(desc);
            body.appendChild(container);
            const div = document.createElement("div");
            div.classList.add("row", "justify-content-end");
            body.appendChild(div);

            const dt = document.createElement("span");
            dt.appendChild(document.createTextNode(data));
            div.append(dt);

            if (i < 3) {
              tablerow1.appendChild(td);
            } else if (i > 2 && i < 6) {
              tablerow2.appendChild(td);
            } else if (i > 5) {
              tablerow3.appendChild(td);
            }

            i += 1;
          }
          //INFINE APPEND SU TABELLA
          document.getElementById("tabellaAppend").appendChild(tablerow1);
          document.getElementById("tabellaAppend").appendChild(tablerow2);
          document.getElementById("tabellaAppend").appendChild(tablerow3);
          resolve();
        });
    }, 450);
  });
}
