<div class="section pt-20 bg-cover bg-no-repeat">
  <!-- section -->
  <div class="container mx-auto">
    <div class="bg__white p-5">
        <p><strong><?php echo $forum->author ?></strong></p>
        <p><?php echo $forum->title ?></p>
        <p><small><?php echo format_dmy($forum->created_date) ?></small></p>
        <?php if(!empty($response)):?>
        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div>
                    <ul>
                        <?php foreach ($response as $row) { ?>                            
                        <li class="grid grid-cols-12 gap-4 mb-5">
                            <div class="col-span-5 md:col-span-6 bg__gray p-5">
                                <span><strong><?php echo $row->author  ?></strong></span>
                                <p><?php echo $row->description ?></p>
                                <small><?php echo format_dmy($row->created_date) ?></small>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php else: ?>
        <p><i>"Belum ada jawaban, jadilah yang pertama menjawab pertanyaan"</i></p>
        <?php endif ?>
        <div class="text-sm">
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
</div>