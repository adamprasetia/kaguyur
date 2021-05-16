var header__mobile = document.querySelector(".header__mobile");
var header__menu__general = document.querySelector(".header__menu__general");
var header__menu__user = document.querySelector(".header__menu__user");
var header__user = document.querySelector(".header__user");

if(header__mobile){
  header__mobile.addEventListener("click", function(){
    header__menu__general.classList.toggle("active");
  });
}
if(header__user){
  header__user.addEventListener("click", function(){
    header__menu__user.classList.toggle("active");
  });
}

// modal
MicroModal.init({
  openTrigger: "data-micromodal-trigger",
  disableScroll: true,
  awaitCloseAnimation: true,
});

//scroll
const header = document.querySelector(".header");
const header_height = header.offsetHeight;

//slider
var sliderEventId = document.querySelector("#slider-event");
if (sliderEventId != null) {
  var sliderEventId = tns({
    container: "#slider-event",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 5,
      },
    },
  });
}
var sliderVideoId = document.querySelector("#slider-video");
if (sliderVideoId != null) {
  var sliderVideoId = tns({
    container: "#slider-video",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderInfografikId = document.querySelector("#slider-infografik");
if (sliderInfografikId != null) {
  var sliderInfografikId = tns({
    container: "#slider-infografik",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderWebinarId = document.querySelector("#slider-webinar");
if (sliderWebinarId != null) {
  var sliderWebinarId = tns({
    container: "#slider-webinar",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderperjalananId = document.querySelector("#slider-perjalanan");
if (sliderperjalananId != null) {
  var sliderperjalananId = tns({
    container: "#slider-perjalanan",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderEtalaseId = document.querySelector("#slider-etalase");
if (sliderEtalaseId != null) {
  var sliderEtalaseId = tns({
    container: "#slider-etalase",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderjagoanId = document.querySelector("#slider-jagoan");
if (sliderjagoanId != null) {
  var sliderjagoanId = tns({
    container: "#slider-jagoan",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderPromotorId = document.querySelector("#slider-promotor");
if (sliderPromotorId != null) {
  var sliderPromotorId = tns({
    container: "#slider-promotor",
    loop: false,
    items: 2.5,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 3,
      },
    },
  });
}
var sliderfotoId = document.querySelector("#slider-foto");
if (sliderfotoId != null) {
  var sliderfotoId = tns({
    container: "#slider-foto",
    loop: false,
    items: 1,
    gutter: 15,
    controls: false,
    mouseDrag: true,
  });
}
var sliderpemanduId = document.querySelector("#slider-pemandu");
if (sliderpemanduId != null) {
  var sliderpemanduId = tns({
    container: "#slider-pemandu",
    loop: false,
    items: 3,
    gutter: 15,
    controls: false,
    mouseDrag: true,
    responsive: {
      768: {
        items: 5,
      },
    },
  });
}
