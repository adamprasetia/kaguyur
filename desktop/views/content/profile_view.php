<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="grid grid-cols-8 gap-4">
      <div class="col-span-2 md:col-span-1">
        <img src="<?php echo gen_thumb($member->logo,'100x100') ?>" alt="<?php echo htmlentities($member->farm) ?>">
      </div>
      <div class="col-span-6">
        <span><strong><?php echo $member->farm ?></strong></span><br>
        <span><?php echo $member->address ?></span><br>
        <span><?php echo $member->phone ?></span>
      </div>
    </div>
    <p><strong>Strain</strong></p>
    <p><?php echo $member->strain ?></p>
    <?php if($member->id==$this->user_login['id']): ?>
    <div class="flex mt-5">
    <a href="<?php echo base_url('profile/edit') ?>" class="btn btn__black">EDIT PROFIL</a>
    </div>
    <?php endif ?>

    <?php if(!empty($product)){ ?>
    <p><strong>Produk</strong></p>
    <?php if($member->id==$this->user_login['id']): ?>
    <div class="flex mt-5">
    <a href="javascript:void(0)" data-micromodal-trigger="modal-product" class="btn btn__black">TAMBAH PRODUK</a>
    </div>
    <?php $this->load->view('content/product_modal_view') ?>         
    <?php endif ?>
    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($product as $row) { ?>        
        <?php $photo = json_decode($row->photo) ?>        
        <a href="<?php echo base_url('produk/'.$row->id.'/'.url_title($row->name,'-',true)) ?>">
        <div class="tns-item tns-slide-active">            
            <div class="slider__etalase__img etalase__img">
              <img class="imgfillImg" src="<?php echo gen_thumb($photo[0],'300x300') ?>" alt="<?php echo $row->name ?>">
            </div>
            <div>
              <p style="margin-bottom:0px" class="font-bold"><?php echo $row->name ?></p>
              <?php if(!empty($row->price)){ ?>
              <small><?php echo 'Rp. '.number_format($row->price) ?></small>
              <?php } ?>
            </div>            
        </div>
        </a>
      <?php $i++;} ?>
    </div>
    <?php } ?>
    
    <?php if(!empty($article) && check_verified(true)){ ?>
    <p><strong>Artikel</strong></p>
    <div class="grid grid-cols-6 gap-10">
      <div class="col-span-6">
          <div class="mt-5">
              <ul>
                  <?php foreach ($article as $row) { ?>                            
                  <li class="grid grid-cols-8 gap-4 mb-5">
                      <?php if(!empty($row->image)): ?>
                      <div class="col-span-3 md:col-span-2">
                          <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'100x100') ?>" alt="" />
                      </div>
                      <?php endif ?>
                      <div class="col-span-5 md:col-span-6">
                          <a href="<?php echo base_url('artikel/edit/'.$row->id.'/'.$row->status) ?>">
                              <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                              <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                              <p class="text-sm text__wrap3"><?php echo $row->status=='PUBLISH'?'Tayang di tanggal '.format_dmy($row->published_date):$row->status ?></p>
                          </a>
                      </div>
                  </li>
                  <?php } ?>
              </ul>
          </div>
      </div>
    </div>
    <?php } ?>
    
    <?php if(!empty($forum)){ ?>
    <p><strong>Forum</strong></p>
    <?php if($member->id==$this->user_login['id']): ?>
      <div class="mt-5">
      <a href="javascript:void(0)" data-micromodal-trigger="modal-forum" class="btn btn__black">KIRIM PERTANYAAN</a>
      </div>
      <?php $this->load->view('content/forum_modal_view') ?>         
    <?php endif ?>
    <div class="grid grid-cols-6 gap-10">
        <div class="col-span-6">
            <div class="mt-5">
                <ul>
                    <?php foreach ($forum as $row) { ?>                            
                    <li class="grid grid-cols-12 gap-4 mb-5">
                        <div class="col-span-5 md:col-span-6">
                            <a href="<?php echo base_url('forum/detail/'.$row->id.'/'.url_title($row->title,'-',true))?>">
                                <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                                <p class="text-sm text__wrap3"><?php echo format_dmy($row->created_date) ?></p>
                            </a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>

  </div>
</div>