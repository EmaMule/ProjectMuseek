function MostraArticoli(email_user) {
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

        const title = document.createElement("h5");
        title.classList.add("card-title");
        title.appendChild(document.createTextNode(titolo));
        body.appendChild(title);

        const desc = document.createElement("p");
        desc.classList.add("card-text");
        desc.appendChild(document.createTextNode(descrizione));
        body.appendChild(desc);

        const a = document.createElement("a");
        a.classList.add("btn");
        a.classList.add("btn-primary");
        a.appendChild(document.createTextNode("Go to article"));
        a.href = "./post_view.php?article=" + id;
        body.appendChild(a);

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
    });
}
