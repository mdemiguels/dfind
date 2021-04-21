document.addEventListener('DOMContentLoaded', function () {

  eventListeners();

  darkMode();



});

function darkMode() {

  const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  if (prefiereDarkMode.matches) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }

  prefiereDarkMode.addEventListener('change', function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  });

  const botonDarkMode = document.querySelector('.dark-mode-boton');
  botonDarkMode.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
  });

}

function eventListeners() {
  const mobileMenu = document.querySelector('.mobile-menu');

  mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector('.navegacion');

  navegacion.classList.toggle('mostrar');
}



//galeria imagenes
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  captionText.innerHTML = dots[slideIndex - 1].alt;
}