<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<style type="text/css">
  .iconrefresh{position:absolute;top:50%;left:50%;font-size:30px;margin:0;}
  .fa-refresh:before{color:white;content:"\f021";}
  .sweet-alert { z-index: 1000000; !important }
  .backdrop__ {position:fixed;top:0;right:0;bottom:0;left:0;z-index:1000000;background-color:#000;}
  .backdrop__in { opacity:.5; }
  .backdrop__out { filter:alpha(opacity=0);opacity:0; }
</style>
<?php if(empty($this->user_login)): ?>
<div class="col-span-6 md:col-span-3 relative mb-5">     
    <div class="relative">
        <h3 class="text-md font-bold">Anda seorang penghoby atau breeder ikan guppy yang berdomisili di Kabupaten Cianjur ?</h3>
            <div class="mt-5 md:pr-20">
              <p>Mari bergabung untuk memajukan dunia perguppian di Kabupaten Cianjur</p>
            </div>
        <div class="flex mt-10">
            <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-login">MASUK</a>
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
    <div class="relative">
        <h3 class="text-md font-bold">Selamat Datang <?php echo $this->user_login['name'] ?>!</h3>
        <div class="mt-5 md:pr-20">
          <img src="<?php echo gen_thumb($this->user_login['logo'],'100x100') ?>" alt="">
          <p><?php echo $this->user_login['farm'] ?></p>
        </div>
        <div class="flex">
          <a href="<?php echo base_url('profile') ?>" class="btn btn__black mr-2">LIHAT PROFIL</a>
          <a href="<?php echo base_url('login/logout') ?>" class="btn btn__black mr-2">KELUAR</a>
        </div>
    </div>             
</div>
<?php endif ?>