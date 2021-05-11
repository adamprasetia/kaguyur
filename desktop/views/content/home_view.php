<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 md:col-span-3 md:pr-10">
        <div>
          <h1 class="font-bold uppercase">KAGUYUR</h1>
          <p class="mb-5"><b>K</b>OMUNIT<b>A</b>S <b>GU</b>PP<b>Y</b> CIANJ<b>UR</b></p>
        </div>

        <img src="<?php echo config_item('assets'); ?>images/bukber.jpeg" alt="" />
        <div class="py-5 md:py-10">
          <p>Wadah untuk membangun kekompakan dan kebersamaan serta berbagi ilmu pengetahuan seputar ikan guppy</p>
          <!-- <p><br><strong>Semangat memajukan dan mengenalkan ikan guppy di Cianjur! </strong></p> -->
        </div>
      </div>
      <div class="col-span-6 md:col-span-3">
        <div class="md:py-20">
          <?php $this->load->view('content/register_view') ?>

          <?php if($this->user_login['status'] == 'VERIFIED'): ?>
          <div class="relative">
              <p>Punya ikan guppy bagus ko di pelihara sendirian..., Ayo promosikan ikan guppy kamu</p>
              <div class="flex">
                <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-product">TAMBAH PRODUK</a>
              </div>
              <p>Ayo bagikan pengetahuan yang kamu miliki seputar budidaya ikan guppy</p>
              <div class="flex">
                <a href="<?php echo base_url('artikel/add') ?>" class="btn btn__black mr-2">TULIS ARTIKEL</a>
              </div>
              <p>Punya pertanyaan seputar budiaya ikan guppy ?</p>
              <div class="flex">
                <a href="<?php echo base_url('forum/add') ?>" class="btn btn__black mr-2">KIRIM PERTANYAAN</a>
              </div>
          </div>    
          <?php $this->load->view('content/product_modal_view') ?>         
          <?php endif ?>

        </div>
      </div>
    </div>
  </div>
</div>