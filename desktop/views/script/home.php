<script type="text/javascript" src="<?php echo config_item('assets'); ?>js/tiny-slider.js"></script>
<script>
var slideranggotaId = document.querySelector("#slider-anggota");
if (slideranggotaId != null) {
  var slideranggotaId = tns({
    container: "#slider-anggota",
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

</script>