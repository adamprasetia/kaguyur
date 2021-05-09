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
              <label class="font-semibold block">Nama Farm</label>
              <input class="field w-full" type="text" name="farm" id="farm"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Nama Lengkap</label>
              <input class="field w-full" type="text" name="name" id="name"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Alamat</label>
              <textarea class="field w-full" name="address" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Mulai Budidaya Sejak</label>
              <input class="field w-full" type="text" name="start" id="start"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">No Telepon/Wa</label>
              <input class="field w-full" type="text" name="phone" id="phone"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Strain Guppy</label>
              <textarea class="field w-full" name="strain" cols="30" rows="10" placeholder="Black moscow, AFR, Blue Grass ..."></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Pas Foto</label>
              <small>Pastikan ukuran file tidak lebih dari 200kb</small>
              <input onchange="check_size(this)" type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block fp__">Logo</label>
              <small>Pastikan ukuran file tidak lebih dari 200kb</small>
              <input onchange="check_size(this)" type="file" name="logo" id="logo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>

            <strong class="pt-5 block">Link Media Sosial</strong>
            <div class="mb-3">
              <label class="font-semibold block">Facebook</label>
              <input type="text" name="fb" id="fb" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Instagram</label>
              <input type="text" name="ig" id="ig" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Twitter</label>
              <input type="text" name="tw" id="tw" class="field w-full"/>
            </div>
            <strong class="pt-5 block">Akun</strong>
            <div class="mb-3">
              <label class="font-semibold block">Email</label>
              <input class="field w-full" type="text" name="email" id="email"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Password</label>
              <input class="field w-full" type="password" name="password" id="password"/>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" id="btn_daftar" data-idle="DAFTAR" data-process="Tunggu Sebentar..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">DAFTAR</button>
            </div>
          </form>
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
          <p class="font-bold">SYARAT</p>
          <p>
            <ol>
              <li>
                Berdomisili di Kabupaten Cianjur
              </li>
              <li>
                Penggemar dan pembudidaya Ikan Hias Guppy yang Aktif
              </li>
            </ol>
          </p>
          <p class="mt-5 font-bold">KETENTUAN</p>
          <p>
            <ol>
              <li>
                Mentaati AD/ART KAGUYUR
              </li>
              <li>
                Memelihara dan Menjaga nama baik KAGUYUR
              </li>
            </ol>
        </p>
        </div>
      </main>
      <footer class="modal__footer"></footer>
    </div>
  </div>
</div>
