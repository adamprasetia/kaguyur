<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-8 gap-4">
      <div class="col-span-2 md:col-span-1">
        <img src="<?php echo gen_thumb($profile->logo,'100x100') ?>" alt="<?php echo htmlentities($profile->farm) ?>">
      </div>
      <div class="col-span-6">
        <span><strong><?php echo $profile->farm ?></strong></span><br>
        <span><?php echo $profile->address ?></span><br>
        <span><?php echo $profile->phone ?></span><br>
      </div>
    </div>
    <div class="flex mt-5">
    <a href="<?php echo base_url('profile/edit') ?>" class="btn btn__black">EDIT PROFIL</a>
    </div>

    <?php if(!empty($product)){ ?>
    <p><strong>Produk</strong></p>
    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($product as $row) { ?>        
        <?php $photo = json_decode($row->photo) ?>        
        <a href="<?php echo base_url('produk/detail/'.$row->id) ?>">
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
    <?php } ?>
  </div>
</div>