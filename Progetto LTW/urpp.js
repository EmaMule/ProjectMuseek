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
const form = document.querySelector("#myForm");
const cityInput = form.querySelector("#input-city");
const countryInput = form.querySelector("#input-country");

form.addEventListener("submit", async (event) => {
  event.preventDefault();

  const city = cityInput.value;
  const country = countryInput.value;

  // effettua la chiamata al servizio di geocoding
  const response = await fetch(
    `https://nominatim.openstreetmap.org/search?q=${city},${country}&format=json&limit=1&accept-language='en'`
  );

  if (response.ok) {
    const data = await response.json();

    if (data.length === 0) {
      // la città o il paese inserito non esiste
      alert("La città o il paese inserito non esiste.");
    } else {
      const displayName = data[0].display_name.toLowerCase();
      const cityLower = city.toLowerCase();
      const countryLower = country.toLowerCase();

      if (
        displayName.includes(cityLower) &&
        displayName.includes(countryLower)
      ) {
        // la città e il paese esistono
        const formData = new FormData(form);
        const response = await fetch("./yourprofile/yourprofile.php", {
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
      } else {
        alert("CITY OR COUNTRY NOT EXISTING");
      }
    }
  } else {
    // errore nella chiamata al servizio di geocoding
    alert("Error connecting to the library");
  }
});
