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
