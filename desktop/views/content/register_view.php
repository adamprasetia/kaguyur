<?php if(empty($this->user_login)): ?>
<div class="col-span-6 md:col-span-3 relative mb-5">     
    <div class="relative">
        <h3 class="text-md font-bold">Kamu seorang penggemar/pembudidaya ikan guppy ?</h3>
        <div class="mt-5">
          <p>Mari bergabung bergabung bersama kami untuk memajukan dunia perguppian di Indonesia</p>
        </div>
        <div class="flex mt-5">
            <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-login">LOGIN</a>
            <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-register">DAFTAR</a>
        </div>
        <div class="flex mt-5">
            <a href="javascript:void(0);" class="btns" data-micromodal-trigger="modal-register-syarat"><u>Syarat &amp; Ketentuan</u></a>
        </div>
    </div>             
</div>

<?php $this->load->view('content/register_modal_view') ?>

<?php else: ?>
  <div class="col-span-6 md:col-span-3 relative mb-5">     
    <a href="<?php echo base_url('profile') ?>">
    <div class="grid grid-cols-8 gap-4">
      <div class="col-span-2 md:col-span-1">
        <img src="<?php echo gen_thumb($this->user_login['logo'],'100x100') ?>" alt="<?php echo htmlentities($this->user_login['farm']) ?>">
      </div>
      <div class="col-span-6">
        <span><strong><?php echo $this->user_login['name'] ?></strong></span><br>
        <span><?php echo $this->user_login['farm'] ?></span><br>
        <span>Status : <strong class="color-<?php echo strtolower($this->user_login['status']) ?>"><?php echo $this->user_login['status'] ?></span></strong>
      </div>
    </div>
    </a>
  </div>
<?php endif ?>