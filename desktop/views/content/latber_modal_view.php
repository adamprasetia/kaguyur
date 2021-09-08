<div class="modal modal__dark micromodal-slide" id="modal-latber" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            PENDAFTARAN
          </h3>
          <small>Edukasi Guppy Kontes & Peresmian FGI Cianjur 2021</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_latber" action="<?php echo base_url('latber/register'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Nama Lengkap *</label>
              <input class="field w-full" type="text" name="fullname" id="fullname"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Nomor Telepon/Wa *</label>
              <input class="field w-full" type="text" name="phone" id="phone"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Alamat *</label>
              <textarea class="field w-full" name="address" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Kelas *</label>
              <select class="field w-full" name="class" id="class" >
                <option value="">- Pilih Kelas -</option>
                <?php foreach ($class as $row) { ?>                  
                <option value="<?php echo $row->name ?>"><?php echo $row->name ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" data-idle="DAFTAR" data-process="Tunggu Sebentar..." data-form="#form_latber" data-redirect="<?php echo current_url(); ?>">DAFTAR</button>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
