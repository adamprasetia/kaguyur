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
              <label class="font-semibold block">Kategori</label>
              <select class="field w-full" name="category" id="category" >
                <option value="IKAN GUPPY" <?php echo isset($product->category) && $product->category=='IKAN GUPPY'?'selected':''?>>IKAN GUPPY</option>
                <option value="PERALATAN & AKSESORI" <?php echo isset($product->category) && $product->category=='PERALATAN & AKSESORI'?'selected':''?>>PERALATAN & AKSESORI</option>
                <option value="PAKAN" <?php echo isset($product->category) && $product->category=='PAKAN'?'selected':''?>>PAKAN</option>
              </select>
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
              <?php if(!empty($product->video_id)){ ?>
                  <iframe width="100%" height="240" src="https://www.youtube.com/embed/<?php echo $product->video_id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <?php } ?>

              <label class="font-semibold block">Url Youtube</label>
              <input class="field w-full" type="text" name="video" id="video" value="<?php echo isset($product->video)?$product->video:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Harga</label>
              <input type="text" name="fb" id="fb" class="field w-full" value="<?php echo isset($product->price)?$product->price:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Status</label>
              <select class="field w-full" name="status" id="status" >
                <option value="ACTIVE" <?php echo isset($product->status) && $product->status=='ACTIVE'?'selected':''?>>ACTIVE</option>
                <option value="NOT ACTIVE" <?php echo isset($product->status) && $product->status=='NOT ACTIVE'?'selected':''?>>NOT ACTIVE</option>
                <option value="DELETED" <?php echo isset($product->status) && $product->status=='DELETED'?'selected':''?>>DELETED</option>
              </select>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('profile') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>