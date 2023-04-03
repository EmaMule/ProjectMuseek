function slide_right_top_g() {
  const slideContainer = document.getElementById("slides_container");
  const slide = document.querySelector(".slide_top_g");
  slideContainer.scrollLeft -= slide.clientWidth;
}

function slide_left_top_g() {
  const slideContainer = document.getElementById("slides_container");
  const slide = document.querySelector(".slide_top_g");
  slideContainer.scrollLeft += slide.clientWidth;
}
