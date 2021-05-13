<div class="section pt-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div>
      <h1 class="font-bold uppercase">KAGUYUR</h1>
      <p class="mb-5"><b>K</b>OMUNIT<b>A</b>S <b>GU</b>PP<b>Y</b> CIANJ<b>UR</b></p>
    </div>

    <div class="grid grid-cols-6 gap-6">
      <div class="col-span-6 md:col-span-3 md:pr-10">
        <a href="<?php echo base_url('artikel/'.$article[0]->id.'/'.url_title($article[0]->title,'-','true')) ?>">
        <img src="<?php echo base_url($article[0]->image) ?>" alt="" />
        <div>
          <p><?php echo $article[0]->title ?></p>
        </div>
        </a>
        
      </div>
      <div class="col-span-6 md:col-span-3 mb-5">        
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

<!-- section -->
<div class="section py-10 relative mt-14 md:mt-0">
    <div class="bg__yellow absolute right-0 w-full  md:w-2/4 md:h-full h-2/4 bottom-0 md:top-0"></div>
    <div class="bg-black absolute left-0 w-full  md:w-2/4  md:h-full h-2/4 top-0"></div>
    <div class="container px-5 mx-auto relative">
      <div class="grid grid-cols-6 gap-10 md:py-5">           
          <div class="col-span-6 md:col-span-3">
          <div>
            <h3 class="text-white text-md font-bold">ANGGOTA</h3>
            <div class="my-5">
              <div class="slider slider__etalase pb-5" id="slider-jagoan">
                <?php $i=1;foreach ($member as $row) { ?>
                <a href="<?php echo base_url('anggota/detail/'.$row->id.'/'.url_title($row->farm,'-',true)) ?>">
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
                <?php $i++;if($i==5) break;} ?>                                 
              </div>
              <div class="mt-10 text-center">
                <a href="<?php echo base_url('anggota') ?>" class="bg__yellow mt-2 text-black btn">ANGGOTA LAINNYA</a>
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
                <?php $i=1;foreach ($product as $row) : ?>
                  <a href="<?php echo base_url('produk/detail/'.$row->id.'/'.url_title($row->id,'-',true)) ?>">
                    <div>
                      <div class="slider__etalase__img">
                        <img class="imgfillImg" src="<?php echo gen_thumb($row->photo,'100x100') ?>" alt="<?php echo htmlentities($row->name) ?>" />
                      </div>
                      <div class="mt-2">
                          <p class="font-bold text__wrap2 mb-0"><?php echo htmlentities($row->name) ?></p>
                          <?php if (!empty($row->price)) {?>                            
                            <small><?php echo number_format($row->price) ?></small>
                          <?php } ?>
                      </div>
                    </div>
                  </a>
                <?php $i++;if($i==5) break;endforeach ?>
              </div>
              <div class="mt-10 text-center">
                <a href="<?php echo base_url('produk') ?>" class="btn btn__black mt-2">PRODUK LAINNYA</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section pt-5 pb-10 md:py-10">
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-6 gap-10">
      <?php if(!empty($article)): ?>
      <div class="col-span-6 md:col-span-3">
        <h4 class="text-md font-bold">ARTIKEL</h4>
        <div class="mt-5">
          <ul>
            <?php foreach ($article as $row) { ?>              
            <li class="grid grid-cols-8 gap-4 mb-5">
              <div class="col-span-3 md:col-span-2">
                  <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'100x100') ?>" alt="<?php echo htmlentities($row->title) ?>">
              </div>
              <div class="col-span-5 md:col-span-6">
                  <a href="<?php echo base_url('artikel/detail/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
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
      </div>
      <?php endif ?>
      <?php if(!empty($forum)): ?>
      <div class="col-span-6 md:col-span-3">
        <h4 class="text-md font-bold">PERTANYAAN</h4>
        <div class="mt-5">
          <ul>
            <?php foreach ($forum as $row) { ?>              
            <li class="grid grid-cols-8 gap-4 mb-5">
              <div class="col-span-6">
                  <a href="<?php echo base_url('forum/detail/'.$row->id.'/'.url_title($row->title,'-',true)) ?>">
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
