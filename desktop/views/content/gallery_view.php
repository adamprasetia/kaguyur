<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">GALERI</h1>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php if(!empty($gallery)) { ?>
        <?php $i=1;foreach ($gallery as $row) { ?>        
            <a href="<?php echo base_url('galeri/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
            <div class="tns-item tns-slide-active">
                <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo gen_thumb($row->cover,'300x300') ?>" alt="<?php echo htmlentities($row->title) ?>">
                </div>
                <div class="mt-2">
                    <p class="font-bold"><?php echo $row->title ?></p>
                </div>
            </div>
            </a>
        <?php $i++;}} ?>
    </div>
  </div>
</div>