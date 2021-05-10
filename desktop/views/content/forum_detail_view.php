<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase"><?php echo $forum->title ?></h1>
    <p><?php echo $forum->author ?></p>
    <p><?php echo format_dmy($forum->created_date) ?></p>
    <p><?php echo $forum->description ?></p>

    <div class="text-sm">
        <form method="post" id="form_data" action="<?php echo base_url('forum/respon/'.$forum->id) ?>">
            <div class="mb-3">
              <label class="font-semibold block">Jawab</label>
              <textarea class="field w-full" name="description" cols="30" rows="5"></textarea>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="KIRIM" data-process="Proses Pengiriman..." data-form="#form_data" data-redirect="<?php echo current_url() ?>">KIRIM</button>
                &nbsp;
                <a href="<?php echo base_url('forum') ?>" class="btn btn__black">KEMBALI</a>
            </div>
        </form>
    </div>
    <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div class="mt-5">
                    <ul>
                        <?php foreach ($response as $row) { ?>                            
                        <li class="grid grid-cols-8 gap-4 mb-5">
                            <div class="col-span-5 md:col-span-6">
                                <p class="text-sm text__wrap3"><?php echo $row->author  ?></p>
                                <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                                <small><?php echo format_dmy($row->created_date) ?></small>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
  </div>
</div>