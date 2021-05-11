<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $title ?></h1>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo $action ?>">
            <div class="mb-3">
              <label class="font-semibold block">Judul</label>
              <input class="field w-full" type="text" name="title" id="title" value="<?php echo isset($data->title)?$data->title:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Deskripsi</label>
              <textarea class="field w-full" name="description" cols="30" rows="5"><?php echo isset($data->description)?$data->description:''; ?></textarea>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="KIRIM" data-process="Proses Pengiriman..." data-form="#form_data" data-redirect="<?php echo base_url('forum') ?>">KIRIM</button>
                &nbsp;
                <a href="<?php echo base_url('forum') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>