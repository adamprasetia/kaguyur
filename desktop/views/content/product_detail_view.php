<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $product->name ?></h1>    
    <a href="<?php echo base_url('anggota/detail/'.$product->created_by) ?>"><img class="w-10 relative" src="<?php echo gen_thumb($product->logo, '100x100') ?>" alt="<?php echo $product->farm ?>"></a>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php 
            if(!empty($product->photo)) { 
                $photo = json_decode($product->photo);
        ?>
        <?php $i=1;foreach ($photo as $row) { ?>        
            <div class="tns-item tns-slide-active">
                <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo gen_thumb($row,'300x300') ?>">
                </div>
            </div>
        <?php $i++;}} ?>
    </div>
    <div>
        <?php echo $product->description ?>
        <?php if(!empty($product->price)){ ?>
        <h1>Rp. <?php echo number_format($product->price) ?></h1>
        <?php } ?>
        <div class="mt-5">
        <a class="btn btn-black" href="https://api.whatsapp.com/send?phone=<?php echo substr($product->phone,0,1)==0?substr_replace($product->phone,'+62',0,1):$product->phone ?>"> 
            BELI PRODUK
        </a>
        <?php if($product->created_by == $this->user_login['id']){ ?>
        &nbsp;
        <a class="btn btn-black" href="<?php echo base_url('produk/edit/'.$product->id) ?>"> 
            EDIT PRODUK
        </a>
        <?php } ?>
        </div>
    </div>
  </div>
</div>