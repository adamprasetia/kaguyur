<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <?php if(check_owner($product->created_by, true)): ?>
        <div class="my-5">
        <a class="btn" href="<?php echo base_url('produk/edit/'.$product->id); ?>"> 
            EDIT PRODUK
        </a>
        </div>
    <?php endif ?>
    <div>
        <h1 class="read__title"><?php echo $product->name ?></h1>  
        <p class="read__date"><?php echo format_dmy($product->created_date) ?></p>
        <div class="mt-5">
        <a href="<?php echo base_url('profile/'.$product->created_by.'/'.url_title($member->farm,'-',true)) ?>">
            <img class="inline w-10 relative" src="<?php echo gen_thumb($member->logo, '100x100') ?>" alt="<?php echo htmlentities($member->farm) ?>">
            <span style="line-height: 40px;"><?php echo $member->farm ?></span>
        </a>
        </div>
    </div>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-6 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <div class="col-span-6 md:col-span-3">
        <div class="slider slider__etalase pb-5" id="slider-product">                
            <?php if(!empty($product->video_id)){ ?>
            <div>
                <div class="slider__etalase__img etalase__img">
                    <iframe width="100%" style="height:240px" src="https://www.youtube.com/embed/<?php echo $product->video_id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <?php } ?>

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
        </div>
        </div>
    </div>
    <div>
        <?php echo $product->description ?>
        <p><strong>Lokasi</strong></p>
        <?php echo $member->address ?>
        <?php if(!empty($product->price)){ ?>
        <h1>Rp. <?php echo number_format($product->price) ?></h1>
        <?php } ?>
        <div class="my-5">
        <a class="btn btn__wa" href="https://api.whatsapp.com/send?phone=<?php echo substr($member->phone,0,1)=='0'?substr_replace($member->phone,'+62',0,1):$member->phone ?>"> 
            HUBUNGI PENJUAL
        </a>
        </div>
        <?php if(!empty($product_member)):?>
        <p><strong>Produk Lainnya</strong></p>
        <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php $i=1;foreach ($product_member as $row) { ?>        
            <?php if($row->id == $product->id){continue;} ?>
            <?php $photo = json_decode($row->photo) ?>        
            <a href="<?php echo base_url('produk/'.$row->id.'/'.url_title($row->name,'-',true)) ?>">
            <div class="tns-item tns-slide-active">            
                <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo gen_thumb($photo[0],'300x300') ?>" alt="<?php echo $row->name ?>">
                </div>
                <div>
                <p style="margin-bottom:0px" class="font-bold"><?php echo $row->name ?></p>
                <?php if(!empty($row->price)){ ?>
                <small><?php echo 'Rp. '.number_format($row->price) ?></small>
                <?php } ?>
                </div>            
            </div>
            </a>
        <?php $i++;} ?>
        </div>
        <?php endif?>
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
        items: 2,
      },
    },
  });
}
</script>
