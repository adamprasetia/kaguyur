<div class="section pt-20 bg-cover bg-no-repeat mt-10 mb-2">
  <!-- section -->
  <div class="container mx-auto">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-6 px-5 md:col-span-6">        
        <?php $this->load->view('content/register_view') ?>
      </div>
    </div>
  </div>
</div>

<div class="section bg-cover bg-no-repeat mb-2">
  <!-- section -->
  <div class="container mx-auto">
    <div class="grid grid-cols-6 gap-4">
      <?php if(!empty($article_pin)): ?>
      <div class="col-span-6 md:col-span-3 md:pr-10">
        <div class="headline">
          <a href="<?php echo base_url('artikel/'.$article_pin[0]->id.'/'.url_title($article_pin[0]->title,'-',true)) ?>">
            <img width="100%" src="<?php echo base_url($article_pin[0]->image) ?>" alt="" />
            <div class="headline-box">
              <?php echo $article_pin[0]->title ?>
              <div><small><?php echo format_dmy($article_pin[0]->published_date) ?></small></div>
            </div>
          </a>
        </div>    
      </div>
      <?php endif ?>    
      <div class="col-span-6 px-5 md:col-span-3">        
        <ul>
          <?php $i=1;foreach ($article as $row) { ?>              
          <li class="grid grid-cols-8 gap-4 mb-5">
            <?php if(!empty($row->image)): ?>
            <div class="col-span-3 md:col-span-2">
                <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'100x100') ?>" alt="<?php echo htmlentities($row->title) ?>">
            </div>
            <?php endif ?>
            <div class="col-span-5 md:col-span-6">
                <a href="<?php echo base_url('artikel/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
                    <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                    <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                    <small><?php echo format_dmy($row->published_date) ?></small>
                </a>
            </div>
          </li>
          <?php $i++;if($i==3)break;} ?>
        </ul>        
      </div>
    </div>
  </div>
</div>

<!-- section -->
<div class="section py-10 relative">
  <div class="bg__yellow absolute right-0 w-full  md:w-2/4 md:h-full h-2/4 bottom-0 md:top-0"></div>
  <div class="bg-black absolute left-0 w-full  md:w-2/4  md:h-full h-2/4 top-0"></div>
  <div class="container px-5 mx-auto relative">
    <div class="grid grid-cols-6 gap-10 md:py-5">           
        <div class="col-span-6 md:col-span-3">
        <div>
          <h3 class="text-white text-md font-bold">ANGGOTA</h3>
          <div class="my-5">
            <div class="slider slider__etalase pb-5" id="slider-anggota">
              <?php $i=1;foreach ($member as $row) { ?>
              <a href="<?php echo base_url('profile/'.$row->id.'/'.url_title($row->farm,'-',true)) ?>">
                <div>
                  <div data-micromodal-trigger="modal-itembelanja0">
                    <div class="slider__etalase__img">
                      <img class="imgfillImg" src="<?php echo gen_thumb($row->photo,'100x100') ?>" alt="<?php echo htmlentities($row->name) ?>" />
                    </div>
                    <div class="mt-2 text-white">
                        <p class="font-bold text__wrap2 mb-0"><?php echo $row->name ?></p>
                        <small><?php echo $row->farm ?></small>
                    </div>
                  </div>
                </div> 
                </a>
              <?php if($i==5) break;$i++;} ?>                                 
            </div>
            <div class="mt-10 text-center">
              <a href="<?php echo base_url('anggota') ?>" style="font-weight:500" class="bg__yellow mt-2 text-black btn">ANGGOTA LAINNYA</a>
            </div>
          </div>
        </div>
      </div>
        <div class="col-span-6 md:col-span-3 pt-5 md:pt-0">
        <div>
          <h3 class="text-md font-bold">PRODUK</h3>
          <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam aliquam repellendus, temporibus soluta deserunt placeat nobis, nostrum voluptates quaerat id quos velit at molestias perferendis! Fugiat enim maiores quo doloremque.</p> -->
          <div class="my-5">
            <div class="slider slider__etalase pb-5" id="slider-etalase">                
              <?php $i=1;foreach ($product as $row) : 
              $photo_prod = json_decode($row->photo);
                ?>
                <a href="<?php echo base_url('produk/'.$row->id.'/'.url_title($row->name,'-',true)) ?>">
                  <div>
                    <div class="slider__etalase__img">
                      <img class="imgfillImg" src="<?php echo gen_thumb($photo_prod[0],'100x100') ?>" alt="<?php echo htmlentities($row->name) ?>" />
                    </div>
                    <div class="mt-2">
                        <p class="text__wrap2 mb-0"><?php echo htmlentities($row->name) ?></p>
                        <?php if (!empty($row->price)) {?>                            
                          <small class="font-bold">Rp. <?php echo number_format($row->price) ?></small>
                        <?php } ?>
                    </div>
                  </div>
                </a>
              <?php if($i==5) break;$i++;endforeach ?>
            </div>
            <div class="mt-10 text-center">
              <?php if(check_verified(true)): ?>
              <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-product"><span style="height: 45px;display: inline-block;">DAFTARKAN&nbsp;PRODUK MU</span></a>
              <?php $this->load->view('content/product_modal_view') ?>         
              <?php endif ?>
              <a href="<?php echo base_url('produk') ?>" class="btn btn__black mt-10">PRODUK&nbsp;LAINNYA</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- section -->
<div class="section pt-0 pb-10 md:py-10 mt-10">
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-10">
    <?php if(!empty($article)): ?>
      <div class="col-span-6 md:col-span-3">
        <h4 class="text-md font-bold">ARTIKEL</h4>
        <div class="mt-5">
          <ul>
            <?php foreach ($article as $row) { ?>              
            <li class="grid grid-cols-8 gap-4 mb-5">
              <?php if(!empty($row->image)): ?>
              <div class="col-span-3 md:col-span-2">
                  <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'100x100') ?>" alt="<?php echo htmlentities($row->title) ?>">
              </div>
              <?php endif ?>
              <div class="col-span-5 md:col-span-6">
                  <a href="<?php echo base_url('artikel/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
                      <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                      <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                      <small><?php echo format_dmy($row->published_date) ?></small>
                  </a>
              </div>
            </li>
            <?php } ?>
          </ul>
          <a href="<?php echo base_url('artikel') ?>" class="text-sm font-semibold mt-5 block text-right">ARTIKEL LAINNYA</a>
        </div>

        <?php $this->load->view('content/artikel_gate_view') ?>
      </div>
      <?php endif ?>

      <?php if(!empty($forum)): ?>
      <div class="col-span-6 md:col-span-3">
        <h4 class="text-md font-bold">FORUM</h4>
        <div class="mt-5">
          <ul>
            <?php foreach ($forum as $row) { ?>              
            <li class="grid grid-cols-8 gap-4 mb-5">
              <div class="col-span-6">
                  <a href="<?php echo base_url('forum/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
                      <h4 class="text__wrap2"><?php echo $row->title ?></h4>
                      <small><?php echo format_dmy($row->created_date) ?></small>
                  </a>
              </div>
            </li>
            <?php } ?>
          </ul>
          <a href="<?php echo base_url('forum') ?>" class="text-sm font-semibold mt-5 block text-right">PERTANYAAN LAINNYA</a>
        </div>
      </div>
      <?php endif ?>

    </div>
  </div>
</div>

<div class="section pt-5 pb-10 md:py-10">
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-10">
    <?php if(check_login(true)):?>
      <div class="col-span-6 md:col-span-3">
        <div>
          <h4 class="text-md font-bold">KIRIM PERTANYAAN</h4>
          <div class="mt-5">
            <p>Punya pertanyaan seputar budiaya ikan guppy ?</p>
            <div class="my-5">
            <form method="post" id="form_data" action="<?php echo base_url('forum/do_add') ?>">
              <div class="mb-3">
                <label class="font-semibold block">Pertanyaan</label>
                <textarea class="field w-full" name="title" cols="30" rows="5"><?php echo isset($data->title)?$data->title:''; ?></textarea>
              </div>
              <div class="flex items-center justify-center my-5">
                  <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="KIRIM" data-process="Proses Pengiriman..." data-form="#form_data" data-redirect="<?php echo current_url() ?>">KIRIM</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <?php endif ?>
      <?php if (!empty($infografik)): ?>
      <div class="col-span-6 md:col-span-3">
        <div class="">
          <h4 class="text-md font-bold">INFOGRAFIK</h4>
          <div class="mt-5">
            <div class="slider slider__square pb-5" id="slider-infografik">
                <?php $i=1;foreach ($infografik as $row) { ?>                  
                <div data-micromodal-trigger="modal-infografik-<?php echo $row->id ?>">
                    <div class="slider__square__img">
                        <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'100x100') ?>" alt="<?php echo htmlentities($row->title) ?>"/>
                    </div>
                </div>
                <?php $i++;if($i==5)break;} ?>
            </div>
          </div>
          <a href="<?php echo base_url('infografik') ?>" class="text-sm font-semibold mt-5 block text-right">INFOGRAFIK LAINNYA</a>
        </div>
      </div>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- [modal-infografik] -->
<?php $i=1;foreach ($infografik as $row) { ?>
<div class="modal modal__dark micromodal-slide" id="modal-infografik-<?php echo $row->id ?>" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <img src="<?php echo base_url($row->image) ?>" alt=""/>
            </main>
            <footer class="modal__footer"></footer>
        </div>
    </div>
</div>
<?php $i++;if($i==5)break;} ?>
