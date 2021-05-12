<div class="section bg-cover bg-no-repeat">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="mt-5">
        <button id="send-question" class="btn btn__black">UPLOAD PHOTO</button>
        <form style="display:none" id="form_data" method="post" action="<?php echo base_url('photo/add'); ?>">
            <input onchange="check_size(this)" type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full" data-form="#form_data" data-redirect="<?php echo base_url('photo') ?>"/>
        </form>
    </div>
    <!-- <div class="grid grid-flow-row grid-rows-1 grid-cols-5 md:grid-cols-5 md:grid-rows-1 gap-4 my-5"> -->
    <div class="grid grid-cols-3 gap-4 my-5">
      <?php $i=1;foreach ($photo as $row) { ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <a href="javascript:void(0)" class="btn_add_photo" data-image="<?php echo base_url($row->url) ?>">
              <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo gen_thumb($row->url,'300x300') ?>" alt="<?php echo htmlentities($row->title) ?>">
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