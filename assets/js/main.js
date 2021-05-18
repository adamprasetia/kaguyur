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
