<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">EDIT PRODUK</h1>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo base_url('photo/update/'.$photo->id) ?>">
            <div class="mb-3">
              <label class="font-semibold block">Foto</label>
              <img src="<?php echo base_url($photo->url); ?>" class="media-object" style="width: 200px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              <input type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Caption</label>
              <input class="field w-full" type="text" name="caption" value="<?php echo isset($photo->title)?$photo->title:''; ?>"/>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo base_url('photo'); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('photo') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>