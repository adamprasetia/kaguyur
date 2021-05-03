<div class="section py-20 bg-cover bg-no-repeat">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 md:col-span-3 md:pr-10">
        <div>
          <h1 class="font-bold uppercase">KAGUYUR</h1>
          <p class="mb-5">Komunitas Guppy Cianjur</p>
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
        </div>
      </div>
    </div>
  </div>
</div>