<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">PRODUK</h1>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php if(!empty($product)) { ?>
        <?php $i=1;foreach ($product as $row) { ?>        
        <?php $photo = json_decode($row->photo) ?>        
            <a href="<?php echo base_url('produk/'.$row->id.'/'.url_title($row->name,'-',true)) ?>">
            <div class="tns-item tns-slide-active">
                <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo gen_thumb($photo[0],'300x300') ?>" alt="<?php echo htmlentities($row->name) ?>">
                </div>
                <div class="mt-2">
                    <p class="font-bold"><?php echo $row->name ?></p>
                </div>
            </div>
            </a>
        <?php $i++;}} ?>
    </div>
  </div>
</div>