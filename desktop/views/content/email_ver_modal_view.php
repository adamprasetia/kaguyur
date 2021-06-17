<p class="color-banned">Email kamu belum terverifikasi, silakan melakukan verifikasi dengan klik tombol di bawah ini</p>
<div class="flex mt-5">
<a href="javascript:void(0)" data-micromodal-trigger="modal-email-ver" class="btn btn__black">VERIFIKASI EMAIL</a>
</div>

<div class="modal modal__dark micromodal-slide" id="modal-email-ver" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            VERIFIKASI EMAIL
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_email_ver" action="<?php echo base_url('verifikasi/send_email'); ?>">
            <p>Kirim email verifikasi ke alamat : <strong><?php echo $this->user_login['email'] ?></strong></p>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" data-idle="KIRIM" data-process="Tunggu Sebentar..." data-form="#form_email_ver" data-redirect="<?php echo current_url(); ?>">KIRIM</button>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
