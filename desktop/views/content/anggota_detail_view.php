<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <!-- <h1 class="font-bold uppercase"><?php echo $member->name ?></h1>     -->
    <div>
        <img src="<?php echo gen_thumb($member->logo,'100x100') ?>" alt="<?php echo htmlentities($member->farm) ?>">
        <p><?php echo $member->farm ?></p>
        <p><?php echo $member->address ?></p>
        <p><?php echo $member->phone ?></p>
        <p><strong>Strain</strong></p>
        <p><?php echo $member->strain ?></p>
    </div>
  </div>
</div>