<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $title ?></h1>
    <p><?php echo format_dmy($published_date) ?></p>
    <?php echo $content ?>
    <p><strong>Penulis</strong></p>
    <?php echo $author ?>
  </div>
</div>