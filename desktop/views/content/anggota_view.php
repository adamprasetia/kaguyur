<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="breadcumb mb-2">
        <ul>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><a href="<?php echo base_url('anggota') ?>">Anggota</a></li>
        </ul>
      </div>
      <p>
Terbuka, Persahabatan, Solidaritas, Kreatif & Innovatif, Apresiatif, Dinamis, 
Berbagi, Kekeluargaan serta Persatuan.</p>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($member as $row) { ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <div data-micromodal-trigger="modal-itembelanja<?php echo $i ?>">
              <div class="slider__etalase__img etalase__img">
                <?php 
                $photo = $row->photo;
                if(empty($photo)){
                  $photo = $row->logo;
                }

                $product = @json_decode(file_get_contents('./assets/json/product_member_'.$row->id.'.json'));
                ?>
                <img class="imgfillImg" src="<?php echo gen_thumb($photo,'300x300') ?>" alt="<?php echo $row->farm ?>">
              </div>
              <div class="mt-2">
                <p style="margin-bottom:0px" class="font-bold"><?php echo $row->name ?></p>
                <small><?php echo $row->farm ?></small>
              </div>
            </div>
          </div>
        </div>        
        <!-- [modal item belanja] -->
        <div class="modal modal__dark micromodal-slide" id="modal-itembelanja<?php echo $i ?>" aria-hidden="true">
          <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
              <header class="modal__header">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
              </header>
              <main class="modal__content" id="modal-1-content">
                <div class="bg-black p-5">
                  <img class="w-10" src="<?php echo config_item('assets').'images/logo2.jpg' ?>" alt="" />
                </div>
                <div class="m-5 text-sm">
                  <div class="grid grid-cols-8 gap-10">
                    <div class="photoprofile col-span-2">
                      <img class="imgfillImg" src="<?php echo gen_thumb($row->logo,'100x100') ?>" alt="" />
                    </div>
                    <div class="col-span-6">
                      <strong><?php echo $row->farm ?></strong>
                      <p class="text-sm deskripsis"><?php echo $row->address ?></p>
                      <span class="text-sm deskripsis"><?php echo $row->phone ?></span>
                    </div>
                  </div>
                </div>
                <div class="text-center m-5">
                  <span class="text-sm font-semibold">
                    Strain
                   </span><br>
                  <span><?php echo $row->strain ?></span>
                </div>

                <?php if(!empty($product)){ ?>
                <div class="grid grid-cols-3 grid-flow-col gap-4 m-5 photoproduk">
                <?php $j=1;foreach ($product as $row_prod) { ?>
                <?php $photo_produk = json_decode($row_prod->photo); ?>
                  <div>
                    <a href="<?php echo base_url('produk/detail/'.$row_prod->id) ?>"><img class="imgfillImg" src="<?php echo gen_thumb($photo_produk[0],'100x100') ?>" alt=""></a>
                  </div>                  
                <?php if($j==3) break;$j++;} ?>
                </div>
                <?php } ?>
                <div class="flex items-center justify-center mb-5">
                  <a class="btn btn__black" href="<?php echo base_url('profile/'.$row->id.'/'.url_title($row->farm,'-',true)) ?>"> Selengkapnya</a>
                </div>
              </main>
              <footer class="modal__footer"></footer>
            </div>
          </div>
        </div>
      <?php $i++;} ?>
    </div>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
    <?php if(!empty($anggota)) { ?>
    <?php foreach ($anggota as $key => $val) { ?>
    <div>
        <div class="tns-item tns-slide-active">
          <div data-micromodal-trigger="modal-itembelanja<?php echo $key; ?>">
            <div class="slider__etalase__img etalase__img">
              <img class="imgfillImg" src="<?php echo img_thumb($val->image[0], 160, 150); ?>" alt="<?php echo $val->nama_usaha; ?>" alt="">
            </div>
            <div class="mt-2">
              <p class="font-bold text__wrap2"><?php echo $val->nama_usaha; ?></p>
              <small><?php echo $val->kota; ?></small>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</div>