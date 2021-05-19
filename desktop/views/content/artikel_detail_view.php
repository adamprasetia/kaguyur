<div class="section mb-10 bg-cover bg-no-repeat mt-30">
  <!-- section -->
  <div class="container mx-auto">
    <div class="px-3 md:px-0">
      <div class="breadcumb mb-2">
        <ul>
          <li><a href="<?php echo base_url() ?>">Home</a></li>
          <li><a href="<?php echo base_url('artikel') ?>">Artikel</a></li>
        </ul>
      </div>
      <h1 class="read__title"><?php echo $article->title ?></h1>
      <p class="read__date"><?php echo format_dmy($article->published_date) ?></p>
    </div>
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-6 md:col-span-4">
        <div class="read__photo mt-2">
          <img src="<?php echo gen_thumb($article->image,'320x240') ?>" alt="">
        </div>
        <div class="read__content px-3 md:px-0">
          <?php echo $article->content ?>
          <p><strong>Penulis</strong></p>
          <?php echo $article->author ?>
        </div>
        <div class="mt-10 px-3 md:px-0">
        <?php $this->load->view('content/artikel_gate_view') ?>
        </div>
      </div>
      <div class="col-span-6 md:col-span-2">
      <?php if(!empty($article_lain)): ?>
      <div class="px-3 md:px-0">
        <h4 class="text-md font-bold">ARTIKEL LAINNYA</h4>
        <div class="mt-5">
          <ul>
            <?php foreach ($article_lain as $row) { ?>
            <?php if($row->id==$article->id){continue;} ?>
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
      </div>
      <?php endif ?>
      </div>
    </div>
  </div>
</div>