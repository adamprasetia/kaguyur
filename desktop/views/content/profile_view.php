<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $profile->name ?></h1>
    <img class="w-32" src="<?php echo base_url($profile->logo) ?>" alt="" />
    <p><?php echo $profile->farm ?></p>
    <p><?php echo $profile->address ?></p>
    <p><?php echo $profile->phone ?></p>
    <p><br><strong>Strain</strong></p><br>
    <p><?php echo $profile->strain ?></p>
    <div class="flex mt-10">
      <a href="<?php echo base_url('profile/edit') ?>" class="btn btn__black mr-2">EDIT PROFIL</a>
    </div>
  </div>
</div>