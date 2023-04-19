//GESTIONE INDICIZZAZIONE ARTICOLI
function forward() {
  const direttiva = "forward";
  jQuery
    .ajax({
      url: "../php-function/archive-indexing.php",
      type: "post",
      data: { direttiva: direttiva },
    })
    .done(function (result) {
      result = JSON.parse(result);
      if (result === "SUCCESS") {
        //RICARICHIAMO LA PAGINA CON INDEX AGGIORNATO SECONDO LE DIRETTIVE UTENTE
        location.reload(() => {
          $(window).scrollTop(0);
        });
      } else {
        //ERRORE
        console.log(result);
      }
    });
}

//LE ALTRE FUNZIONI IMPLEMENTANO LA STESSA LOGICA CAMBIANDO LA DIRETTIVA
function backward() {
  const direttiva = "backward";
  jQuery
    .ajax({
      url: "../php-function/archive-indexing.php",
      type: "post",
      data: { direttiva: direttiva },
    })
    .done(function (result) {
      result = JSON.parse(result);
      if (result === "SUCCESS") {
        location.reload(() => {
          $(window).scrollTop(0);
        });
      } else {
        console.log(result);
      }
    });
}

function forwardForward() {
  const direttiva = "forward-forward";
  jQuery
    .ajax({
      url: "../php-function/archive-indexing.php",
      type: "post",
      data: { direttiva: direttiva },
    })
    .done(function (result) {
      result = JSON.parse(result);
      if (result === "SUCCESS") {
        location.reload(() => {
          $(window).scrollTop(0);
        });
      } else {
        console.log(result);
      }
    });
}

function backwardBackward() {
  const direttiva = "backward-backward";
  jQuery
    .ajax({
      url: "../php-function/archive-indexing.php",
      type: "post",
      data: { direttiva: direttiva },
    })
    .done(function (result) {
      result = JSON.parse(result);
      if (result === "SUCCESS") {
        location.reload(() => {
          $(window).scrollTop(0);
        });
      } else {
        console.log(result);
      }
    });
}
