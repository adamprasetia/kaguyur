<div class="modal modal__dark micromodal-slide" id="modal-register" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-md">
            DAFTARKAN <br />DIRIMU DI SINI
          </h3>
          <small>#Kaguyur Growth Together</small>
        </div>
        <div class="p-5 text-sm">
          <form method="post" id="form_data" action="<?php echo base_url('anggota/register'); ?>">
            <div class="mb-3">
              <label class="font-semibold block">Nama Lengkap</label>
              <input class="field w-full" type="text" name="name" id="name"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Alamat</label>
              <textarea class="field w-full" name="address" cols="30" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">No Telepon/Wa</label>
              <input class="field w-full" type="text" name="phone" id="phone"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Email</label>
              <input class="field w-full" type="text" name="email"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Password</label>
              <input class="field w-full" type="password" name="password"/>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" data-idle="DAFTAR" data-process="Tunggu Sebentar..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">DAFTAR</button>
            </div>
          </form>
          <div class="text-center">
            <p><a href="javascript:void(0);" onclick="MicroModal.close('modal-register');" data-micromodal-trigger="modal-login">Sudah punya akun ? silakan login disini </a></p>
          </div>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
<div class="modal modal__dark micromodal-slide" id="modal-register-syarat" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </header>
      <main class="modal__content" id="modal-1-content">
        <div class="bg__yellow p-5">
          <h3 class="font-bold uppercase text-sm">SYARAT DAN KETENTUAN</h3>
        </div>
        <div class="p-5 bg__gray2 text-sm text-white">
          <p class="font-bold">SYARAT DAN KETENTUAN</p>
          <p>
            <ol>
              <li>
                Penggemar dan pembudidaya Ikan Hias Guppy yang Aktif
              </li>
              <li>
                Memelihara dan Menjaga nama baik Komunitas
              </li>
              <li>
                Dilarang membuat konten diluar ikan guppy
              </li>
              <li>
                Dilarang menjual produk yang tidak berhubugan dengan ikan guppy
              </li>
            </ol>
          </p>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
