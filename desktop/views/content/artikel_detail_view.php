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
      <h1 class="read__title"><?php echo $title ?></h1>
      <p class="read__date"><?php echo format_dmy($published_date) ?></p>
    </div>
    <div class="read__photo mt-2">
      <img src="<?php echo gen_thumb($image,'320x240') ?>" alt="">
    </div>
    <div class="read__content px-3 md:px-0">
      <?php echo $content ?>
      <p><strong>Penulis</strong></p>
      <?php echo $author ?>
    </div>
  </div>
</div>