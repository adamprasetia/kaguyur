<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">EDIT PRODUK</h1>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo base_url('produk/update/'.$product->id) ?>">
            <div class="mb-3">
              <label class="font-semibold block">Nama Produk</label>
              <input class="field w-full" type="text" name="name" id="name" value="<?php echo isset($product->name)?$product->name:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Deskripsi</label>
              <textarea class="field w-full" name="description" cols="30" rows="10"><?php echo isset($product->description)?$product->description:''; ?></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Foto</label>
              <?php if(!empty($product->photo)): 
              $photo = json_decode($product->photo);
                ?>
              <img src="<?php echo isset($photo[0])?base_url($photo[0]):''; ?>" class="media-object" style="width: 200px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              <?php endif ?>
              <input onchange="check_size(this)" type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Harga</label>
              <input type="text" name="fb" id="fb" class="field w-full" value="<?php echo isset($product->price)?$product->price:''; ?>"/>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('anggota/detail/'.$this->user_login['id']) ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>