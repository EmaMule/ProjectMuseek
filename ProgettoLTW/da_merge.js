//x il carosello
let cube = document.querySelector(".carousel_top_g");
let btnN = document.getElementById("next");
let btnP = document.getElementById("prev");
let pos = 0;

btnN.addEventListener("click", () => {
  pos -= 90;
  cube.style.transform = "rotateY(" + pos + "deg)";
});

btnP.addEventListener("click", () => {
  pos += 90;
  cube.style.transform = "rotateY(" + pos + "deg)";
});

function setupAnimation_top_g() {
  const options = {
    rootMargin: "0px 0px -50px 0px",
    threshold: 0,
    root: null,
  };

  //l'osservatore Javascript prende una lista di entries e l'oggetto stesso
  //e può applicare un'azione per ogni entry appena lo schermo scrolla arrivando a "rootMargin"

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show_top_g");
        //observer.unobserve(entry.target);
      } else {
        entry.target.classList.remove("show_top_g");
      }
    });
  }, options);

  //tutti gli elementi su cui applico l'animazione
  const header1 = document.querySelector(".footer_section_header_top_g");
  observer.observe(header1);
  const imgina = document.querySelector(".img_center_top_g");
  observer.observe(imgina);
  const header2 = document.querySelector(".header_center_top_g");
  observer.observe(header2);
  const paras = document.querySelectorAll("p");
  paras.forEach((p) => observer.observe(p));
  const imgss = document.querySelectorAll(".footer_img_top_g");
  imgss.forEach((i) => observer.observe(i));
}

//animazioni testo
window.addEventListener("DOMContentLoaded", setupAnimation_top_g);
