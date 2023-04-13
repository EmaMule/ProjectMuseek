window.addEventListener("scroll", reveal);

function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowheight = window.innerHeight;
    var revealtop = reveals[i].getBoundingClientRect().top;
    var revealpoint = 45;

    if (revealtop < windowheight - revealpoint) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}
/* Then, it loops through each of these elements and gets the distance between the top of the element and the top of
 the viewport using the getBoundingClientRect() method. It also gets the height of the viewport using the window.innerHeight 
 property.

Next, it sets a variable called revealpoint to 150. This variable represents the distance from the bottom of 
the viewport at which point the reveal effect should trigger.

Finally, it checks if the distance between the top of the element and the top of the viewport is less 
than the viewport height minus the revealpoint value. If this is true, it adds the "active" class to the element, 
triggering the reveal effect. Otherwise, it removes the "active" class.*/
