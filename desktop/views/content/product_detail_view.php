<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $product->name ?></h1>    
    <div>
    <a href="<?php echo base_url('anggota/detail/'.$product->created_by) ?>">
        <img class="inline w-10 relative" src="<?php echo gen_thumb($product->logo, '100x100') ?>" alt="<?php echo $product->farm ?>">
        <span style="line-height: 40px;"><?php echo $product->farm ?></span>
    </a>
    </div>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-6 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <div class="col-span-6 md:col-span-3">
        <div class="slider slider__etalase pb-5" id="slider-product">                
            <?php 
                if(!empty($product->photo)) { 
                    $photo = json_decode($product->photo);
            ?>
            <?php $i=1;foreach ($photo as $row) { ?>        
                <div>
                    <div class="slider__etalase__img etalase__img">
                        <img class="imgfillImg" src="<?php echo base_url($row) ?>">
                    </div>
                </div>
            <?php $i++;}} ?>
            <?php if(!empty($product->video_id)){ ?>
            <div>
                <div class="slider__etalase__img etalase__img">
                    <iframe width="100%" style="height:240px" src="https://www.youtube.com/embed/<?php echo $product->video_id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php } ?>
        </div>
        </div>
    </div>
    <div>
        <?php echo $product->description ?>
        <?php if(!empty($product->price)){ ?>
        <h1>Rp. <?php echo number_format($product->price) ?></h1>
        <?php } ?>
        <div class="mt-5">
        <a class="btn btn-black" href="https://api.whatsapp.com/send?phone=<?php echo substr($product->phone,0,1)=='0'?substr_replace($product->phone,'+62',0,1):$product->phone ?>"> 
            BELI PRODUK
        </a>
        <?php if($product->created_by == $this->user_login['id']){ ?>
        &nbsp;
        <a class="btn btn-black" href="<?php echo base_url('produk/edit/'.$product->id) ?>"> 
            EDIT PRODUK
        </a>
        <?php } ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo config_item('assets'); ?>js/tiny-slider.js"></script>
<script>
var sliderEtalaseId = document.querySelector("#slider-product");
if (sliderEtalaseId != null) {
  var sliderEtalaseId = tns({
    container: "#slider-product",
    loop: false,
    items: 1,
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