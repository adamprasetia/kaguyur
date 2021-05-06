<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">ANGGOTA</h1>
      <p>
Terbuka, Persahabatan, Solidaritas, Kreatif & Innovatif, Apresiatif, Dinamis, 
Berbagi, Kekeluargaan serta Persatuan.</p>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($member as $row) { ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <div data-micromodal-trigger="modal-itembelanja<?php echo $i ?>">
              <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo base_url($row->photo) ?>" alt="<?php echo $row->farm ?>">
              </div>
              <div class="mt-2">
                <p class="font-bold"><?php echo $row->name ?></p>
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
                <div class="p-5 text-sm">
                  <div class="grid grid-cols-8 gap-10">
                    <div class="photoprofile col-span-2">
                      <img class="imgfillImg" src="<?php echo base_url($row->logo) ?>" alt="" />
                    </div>
                    <div class="col-span-6">
                      <strong><?php echo $row->farm ?></strong>
                      <p class="text-sm deskripsis"><?php echo $row->name ?></p>
                      <p class="text-sm deskripsis"><?php echo $row->address ?></p>
                      <p class="text-sm deskripsis"><?php echo $row->phone ?></p>
                    </div>
                  </div>
                </div>
                <div class="text-center px-5 pb-5">
                  <p class="text-sm font-semibold">
                    Strain
                  </p>
                  <p><?php echo $row->strain ?></p>
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