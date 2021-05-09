<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <!-- <h1 class="font-bold uppercase"><?php echo $member->name ?></h1>     -->
    <div>
        <img src="<?php echo gen_thumb($member->logo,'100x100') ?>" alt="<?php echo htmlentities($member->farm) ?>">
        <p><?php echo $member->farm ?></p>
        <p><?php echo $member->address ?></p>
        <p><?php echo $member->phone ?></p>
        <p><strong>Strain</strong></p>
        <p><?php echo $member->strain ?></p>
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