<div class="section bg-cover bg-no-repeat mt-5">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h4 class="font-bold uppercase"><?php echo $title ?></h4>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo $action ?>">
            <div class="mb-3">
              <label class="font-semibold block">Judul Video</label>
              <input class="field w-full" type="text" name="title" id="title" value="<?php echo isset($video->title)?$video->title:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Link Youtube</label>
              <input class="field w-full" type="text" name="url" id="url" value="<?php echo isset($video->url)?$video->url:''; ?>"/>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo base_url('video'); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('video') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>