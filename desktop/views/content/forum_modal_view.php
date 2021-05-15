<div class="modal modal__dark micromodal-slide" id="modal-forum" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            KIRIM PERTANYAAN
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_forum" action="<?php echo base_url('forum/do_add'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Pertanyaan *</label>
              <textarea class="field w-full" name="title" cols="30" rows="10"></textarea>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" data-idle="KIRIM" data-process="Tunggu Sebentar..." data-form="#form_forum" data-redirect="<?php echo current_url(); ?>">KIRIM</button>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
