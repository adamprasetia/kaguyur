<div class="modal modal__dark micromodal-slide" id="modal-product" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            TAMBAH PRODUK
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_product" action="<?php echo base_url('produk/add'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Nama Produk *</label>
              <input class="field w-full" type="text" name="name" id="name"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Deskripsi *</label>
              <textarea class="field w-full" name="description" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Link Video (Youtube)</label>
              <input class="field w-full" type="text" name="video" id="video"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Foto *</label>
              <small>Pastikan ukuran file tidak lebih dari 1 MB</small>
              <input onchange="check_size(this)" type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Harga</label>
              <small>Harga boleh tidak disi</small>
              <input class="field w-full" type="number" name="price" id="price"/>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" data-idle="SIMPAN" data-process="Tunggu Sebentar..." data-form="#form_product" data-redirect="<?php echo current_url(); ?>">SIMPAN</button>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
