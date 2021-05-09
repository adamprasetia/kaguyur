<div class="modal modal__dark micromodal-slide" id="modal-login" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            LOGIN
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_login" action="<?php echo base_url('login/do_login'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Email</label>
              <input class="field w-full" type="text" name="email" id="email"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Password</label>
              <input class="field w-full" type="password" name="password" id="password"/>
              <p><a href="javascript:void(0);" data-micromodal-close data-micromodal-trigger="modal-forgote">Lupa password ? klik disini</a></p>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" id="btn_daftar" data-idle="MASUK" data-process="Tunggu Sebentar..." data-form="#form_login" data-redirect="<?php echo current_url(); ?>">MASUK</button>
            </div>
            <div class="text-center">
            <p><a href="javascript:void(0);" data-micromodal-close data-micromodal-trigger="modal-register">Belum punya akun ? silakan daftar disini </a></p>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
<div class="modal modal__dark micromodal-slide" id="modal-forgote" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            LUPA PASSWORD
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_forgote" action="<?php echo base_url('login/forgote'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Masukan email anda</label>
              <input class="field w-full" type="text" name="email" id="email"/>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" id="btn_daftar" data-idle="KIRIM" data-process="Tunggu Sebentar..." data-form="#form_forgote" data-redirect="<?php echo current_url(); ?>">KIRIM</button>
            </div>
          </form>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
