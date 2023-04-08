document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
  const dropZoneElement = inputElement.closest(".drop-zone");

  dropZoneElement.addEventListener("click", (e) => {
    inputElement.click();
  });

  inputElement.addEventListener("change", (e) => {
    if (inputElement.files.length) {
      updateThumbnail(dropZoneElement, inputElement.files[0]);
    }
  });
  dropZoneElement.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoneElement.classList.add("drop-zone--over");
  });
  ["dragleave", "dragend"].forEach((type) => {
    dropZoneElement.addEventListener(type, (e) => {
      dropZoneElement.classList.remove("drop-zone--over");
    });
  });

  dropZoneElement.addEventListener("drop", (e) => {
    e.preventDefault();
    if (e.dataTransfer.files.length) {
      inputElement.files = e.dataTransfer.files;
      updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
    }
    dropZoneElement.classList.remove("drop-zone--over");
  });
});

function updateThumbnail(dropZoneElement, file) {
  let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
  if (dropZoneElement.querySelector(".drop-zone__prompt")) {
    dropZoneElement.querySelector(".drop-zone__prompt").remove();
  }
  if (!thumbnailElement) {
    thumbnailElement = document.createElement("div");
    thumbnailElement.classList.add("drop-zone__thumb");
    dropZoneElement.appendChild(thumbnailElement);
  }
  thumbnailElement.dataset.label = file.name;

  if (file.type.startsWith("image/")) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
      thumbnailElement.style.backgroundImage = "url(" + reader.result + ")";
    };
  } else {
    console.log("au");
    thumbnailElement.style.backgroundImage = "none";
    thumbnailElement.style.backgroundColor = "red";
  }
}
const inputContainer = document.getElementById("input-container");
const addInputButton = document.getElementById("add-input-button");
const removeInputButton = document.getElementById("remove-input-button");
let inputCount = 0;

// Aggiungi un nuovo campo input
function addInput() {
  if (inputCount < 5) {
    inputCount++;
    const newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = `input-${inputCount}`;
    newInput.classList.add(
      "form-control",
      "mb-2",
      "input-hidden",
      "input-transition"
    );
    inputContainer.appendChild(newInput);
    setTimeout(() => {
      newInput.classList.remove("input-hidden");
      newInput.classList.add("input-visible");
    }, 50);

    // Aggiungi il pulsante "-" dopo il primo input aggiunto
    if (inputCount === 1) {
      removeInputButton.style.display = "inline-block";
    }

    // Nascondi il pulsante "+" dopo l'aggiunta di 5 campi input
    if (inputCount === 5) {
      addInputButton.style.display = "none";
    }
  }
}

// Rimuovi l'ultimo campo input aggiunto
function removeInput() {
  if (inputCount > 0) {
    const lastInput = inputContainer.lastChild;
    inputContainer.removeChild(lastInput);
    inputCount--;

    // Mostra il pulsante "+" quando almeno un campo input è stato rimosso
    if (inputCount < 5) {
      addInputButton.style.display = "inline-block";
    }

    // Nascondi il pulsante "-" quando non ci sono più input da rimuovere
    if (inputCount === 0) {
      removeInputButton.style.display = "none";
    }
  }
}

// Aggiungi un listener per il click del pulsante "+"
addInputButton.addEventListener("click", addInput);

// Aggiungi un listener per il click del pulsante "-"
removeInputButton.addEventListener("click", removeInput);
