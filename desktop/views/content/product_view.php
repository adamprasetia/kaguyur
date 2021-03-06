<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="breadcumb mb-2">
      <ul>
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo base_url('produk') ?>">Produk</a></li>
      </ul>
    </div>

    <form method="get" id="form_data_pencarian" action="<?php echo base_url('produk'); ?>">
      <div class="mb-3">
        <input class="field w-full" type="text" name="search" id="search" placeholder="Pencarian..." value="<?php echo htmlentities($this->input->get('search',true)) ?>"/>
      </div>
    </form>

    <script>
      // Get the input field
      var input = document.getElementById("search");

      // Execute a function when the user releases a key on the keyboard
      input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
          // Cancel the default action, if needed
          event.preventDefault();
          console.log('sss');
          // Trigger the button element with a click
          // document.getElementById("myBtn").click();
          document.getElementById("form_data_pencarian").submit();
        }
      });
    </script>

    <?php if(check_verified(true)): ?>
    <div class="mt-10">    
      <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-product"><span style="height: 45px;display: inline-block;">DAFTARKAN&nbsp;PRODUK MU</span></a>
    </div>
    <?php $this->load->view('content/product_modal_view') ?>         
    <?php elseif(check_login(true)): ?>

    <?php else: ?>
    <p>Ingin produk kamu tampil di sini?, ayo gabung bersama kami</p>
    <div class="flex mb-2">
        <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-register">DAFTAR DISINI</a>
        <a href="javascript:void(0);" class="btn mr-2" data-micromodal-trigger="modal-register-syarat">Syarat &amp; Ketentuan</a>
    </div>
    <?php $this->load->view('content/register_modal_view') ?>
    <?php endif ?>

    <p>Filter Berdasarkan Kategori</p>
    <div class="flex mb-2">
        <a href="<?php echo base_url('produk?category=').urlencode('Ikan Guppy') ?>" class="btn <?php echo $this->input->get('category',true)==urldecode('Ikan Guppy')?'':'btn__black'?> mr-2">IKAN GUPPY</a>
        <a href="<?php echo base_url('produk?category=').urlencode('Peralatan & Aksesori') ?>" class="btn <?php echo $this->input->get('category',true)==urldecode('Peralatan & Aksesori')?'':'btn__black'?> mr-2">PERALATAN & AKSESORI</a>
        <a href="<?php echo base_url('produk?category=').urlencode('Pakan & Obat') ?>" class="btn <?php echo $this->input->get('category',true)==urldecode('Pakan & Obat')?'':'btn__black'?> mr-2">PAKAN & OBAT</a>
    </div>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php if(!empty($product)) { ?>
        <?php $i=1;foreach ($product as $row) { ?>        
        <?php $photo = json_decode($row->photo) ?>        
            <a href="<?php echo base_url('produk/'.$row->id.'/'.url_title($row->name,'-',true)) ?>">
            <div class="tns-item tns-slide-active">
                <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo gen_thumb($photo[0],'300x300') ?>" alt="<?php echo htmlentities($row->name) ?>">
                </div>
                <div class="mt-2">
                    <span><?php echo $row->name ?></span><br>
                    <?php if (!empty($row->price)) {?>                            
                      <small class="font-bold">Rp. <?php echo number_format($row->price) ?></small>
                    <?php } ?>
                </div>
            </div>
            </a>
            
        <?php $i++;}}else{ ?>
        <p>Maaf, kami tidak menemukan produk yang anda cari</p>
        <?php } ?>
    </div>
    <div class="paging">
      <?php echo $paging ?>      
    </div>
  </div>
</div>