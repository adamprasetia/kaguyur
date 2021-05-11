<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">PHOTO</h1>
    <?php if(check_verified(true)): ?>
    <div class="mt-5">
        <button id="send-question" class="btn btn__black">UPLOAD PHOTO</button>
        <form style="display:none" id="form_data" method="post" action="<?php echo base_url('photo/add'); ?>">
            <input type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full" data-form="#form_data" data-redirect="<?php echo base_url('photo') ?>"/>
        </form>
    </div>
    <?php endif ?>
    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($photo as $row) { 
        $url = 'javascript:void(0)';
        if(check_verified(true) && check_owner($row->created_by, true)){
          $url = base_url('photo/edit/'.$row->id);
        }
        ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <a href="<?php echo $url ?>">
              <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo gen_thumb($row->url,'300x300') ?>" alt="<?php echo htmlentities($row->title) ?>">
              </div>
              <div class="mt-2">
                <p style="margin-bottom:0px" class="font-bold"><?php echo $row->title ?></p>
              </div>
            </a>
          </div>
        </div>        
      <?php $i++;} ?>
    </div>
  </div>
</div>