<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">LOGIN</h1>
    <div class="text-sm">
        <form method="post" id="form_data" action="<?php echo base_url('login/do_login') ?>">
            <div class="mb-3">
              <label class="font-semibold block">Email</label>
              <input class="field w-full" type="text" name="email" id="email"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Password</label>
              <input class="field w-full" type="password" name="password" id="password"/>
            </div>
            <div class="flex items-center justify-center my-5">
              <button type="button" class="btn btn__black btn_action" id="btn_login" data-idle="MASUK" data-process="Tunggu..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">MASUK</button>
            </div>
          </form>
        </div>
    </div>
</div>