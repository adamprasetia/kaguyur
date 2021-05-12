<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 md:col-span-3 md:pr-10">
        <div>
          <h1 class="font-bold uppercase">KAGUYUR</h1>
          <p class="mb-5"><b>K</b>OMUNIT<b>A</b>S <b>GU</b>PP<b>Y</b> CIANJ<b>UR</b></p>
        </div>
        <a href="<?php echo base_url('artikel/'.$article[0]->id.'/'.url_title($article[0]->title,'-','true')) ?>">
        <img src="<?php echo base_url($article[0]->image) ?>" alt="" />
        <div class="py-5 md:py-10">
          <p><?php echo $article[0]->title ?></p>
        </div>
        </a>
      </div>
      <div class="col-span-6 md:col-span-3">
        <div class="md:py-20">
          <?php $this->load->view('content/register_view') ?>

          <?php if(check_verified(true)): ?>
          <div class="relative">
              <p>Punya ikan guppy bagus ko di pelihara sendirian..., Ayo promosikan ikan guppy kamu</p>
              <div class="flex">
                <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-product">TAMBAH PRODUK</a>
              </div>
              <p>Ayo bagikan pengetahuan yang kamu miliki seputar budidaya ikan guppy</p>
              <div class="flex">
                <a href="<?php echo base_url('artikel/add') ?>" class="btn btn__black mr-2">TULIS ARTIKEL</a>
              </div>
          </div>    
          <?php $this->load->view('content/product_modal_view') ?>         
          <?php endif ?>
          <?php if(check_login(true)): ?>
          <p>Punya pertanyaan seputar budiaya ikan guppy ?</p>
          <div class="flex">
            <a href="<?php echo base_url('forum/add') ?>" class="btn btn__black mr-2">KIRIM PERTANYAAN</a>
          </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>