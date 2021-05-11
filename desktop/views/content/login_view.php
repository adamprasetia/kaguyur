<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">LOGIN</h1>
      <div class="text-sm">
        <form method="post" id="form_data" action="<?php echo $action ?>">
          <div class="mb-3">
            <label class="font-semibold block">Email</label>
            <input class="field w-full" type="text" name="email"/>
          </div>
          <div class="mb-3">
            <label class="font-semibold block">Password</label>
            <input class="field w-full" type="password" name="password"/>
            <p><a href="javascript:void(0);" onclick="MicroModal.close('modal-login');" data-micromodal-trigger="modal-forgote">Lupa password ? klik disini</a></p>
          </div>
          <div class="flex items-center justify-center my-5">
            <button type="button" class="btn btn__black btn_action" id="btn_login" data-idle="MASUK" data-process="Tunggu..." data-form="#form_data" data-redirect="<?php echo $callback; ?>">MASUK</button>
          </div>
        </form>
          <div class="text-center">
            <p><a href="javascript:void(0);" onclick="MicroModal.close('modal-login');" data-micromodal-trigger="modal-register">Belum punya akun ? silakan daftar disini </a></p>
          </div>
      </div>
    </div>
</div>