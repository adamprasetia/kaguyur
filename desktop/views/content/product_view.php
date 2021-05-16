<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="breadcumb mb-2">
      <ul>
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo base_url('produk') ?>">Produk</a></li>
      </ul>
    </div>

    <form method="get" id="form_data" action="<?php echo base_url('produk'); ?>">
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
          document.getElementById("form_data").submit();
        }
      });
    </script>

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
                    <p class="font-bold"><?php echo $row->name ?></p>
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