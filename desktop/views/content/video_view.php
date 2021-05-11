<div class="section bg-cover bg-no-repeat">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="mt-5">
        <a href="<?php echo base_url('video/add') ?>" class="btn btn__black">TAMBAH VIDEO</a>
    </div>
    <div class="grid grid-cols-3 gap-4 my-5">
      <?php $i=1;foreach ($video as $row) { ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <a href="javascript:void(0)" class="btn_add_video" data-image="<?php echo base_url($row->id_youtube) ?>" data-embed="<?php echo 'https://www.youtube.com/embed/'.$row->id_youtube ?>">
              <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo 'https://i1.ytimg.com/vi/'.$row->id_youtube.'/mqdefault.jpg'; ?>" alt="<?php echo htmlentities($row->title) ?>">
              </div>
            </a>
          </div>
        </div>        
      <?php $i++;} ?>
    </div>
    <div class="paging">
      <?php echo $paging ?>      
    </div>
  </div>
</div>