<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $product->name ?></h1>    
    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php 
            if(!empty($product->photo)) { 
                $photo = json_decode($product->photo);
        ?>
        <?php $i=1;foreach ($photo as $row) { ?>        
            <div class="tns-item tns-slide-active">
                <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo base_url($row) ?>">
                </div>
            </div>
        <?php $i++;}} ?>
    </div>
    <div>
        <?php echo $product->description ?>
        <h1>Rp. <?php echo number_format($product->price) ?></h1>
        <div class="mt-5">
        <a class="btn btn-black" href=""> 
            BELI PRODUK
        </a>
        </div>
    </div>
  </div>
</div>