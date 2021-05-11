<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $forum->title ?></h1>
    <p><?php echo $forum->description ?></p>
    <p><?php echo $forum->author ?> - <small><?php echo format_dmy($forum->created_date) ?></small></p>
    <?php if(!empty($response)):?>
    <h4>Jawaban</h4>
    <div class="grid grid-cols-6 gap-10">
        <div class="col-span-6 md:col-span-3">
            <div class="mt-5">
                <ul>
                    <?php foreach ($response as $row) { ?>                            
                    <li class="grid grid-cols-12 gap-4 mb-5">
                        <div class="col-span-5 md:col-span-6">
                            <h4 class="mb-2 text__wrap2"><?php echo $row->description ?></h4>
                            <p class="text-sm text__wrap3"><?php echo $row->author  ?> - <small><?php echo format_dmy($row->created_date) ?></small></p>                                
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <?php else: ?>
    <h4>Belum ada jawaban, jadilah yang pertama menjawab pertanyaan</h4>
    <?php endif ?>

    <div class="text-sm mt-5">
        <?php if(check_login(true)):?>
        <form method="post" id="form_data" action="<?php echo base_url('forum/respon/'.$forum->id) ?>">
            <div class="mb-3">
              <label class="font-semibold block">Kirim jawaban kamu</label>
              <textarea class="field w-full" name="description" cols="30" rows="5"></textarea>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="KIRIM" data-process="Proses Pengiriman..." data-form="#form_data" data-redirect="<?php echo current_url() ?>">KIRIM</button>
            </div>
            <div class="text-center">
            <a href="<?php echo base_url('forum/add') ?>">Kamu punya pertanyaan lain ? Klik disini</a>
            </div>
        </form>        
        <?php else: ?>
        <a class="btn btn-black" href="<?php echo base_url('login?callback='.current_url()) ?>">Login untuk menjawab pertanyaan</a>
        <?php endif ?>
    </div>
    

  </div>
</div>