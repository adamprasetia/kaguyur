<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <div class="breadcumb mb-2">
            <ul>
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url('forum') ?>">Forum</a></li>
            </ul>
        </div>
        <?php if(check_login(true)):?>
      <div class="col-span-6 md:col-span-3">
        <div>
          <h4 class="text-md font-bold">KIRIM PERTANYAAN</h4>
          <div class="mt-5">
            <p>Punya pertanyaan seputar budiaya ikan guppy ?</p>
            <div class="my-5">
            <form method="post" id="form_data" action="<?php echo base_url('forum/do_add') ?>">
              <div class="mb-3">
                <label class="font-semibold block">Pertanyaan</label>
                <textarea class="field w-full" name="title" cols="30" rows="5"><?php echo isset($data->title)?$data->title:''; ?></textarea>
              </div>
              <div class="flex items-center justify-center my-5">
                  <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="KIRIM" data-process="Proses Pengiriman..." data-form="#form_data" data-redirect="<?php echo current_url() ?>">KIRIM</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
        <p>Ingin pertanyaan kamu muncul disini dan dijawab oleh para expert, mari bergabung bersama kami</p>
        <div class="flex mb-2">
            <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-register">DAFTAR DISINI</a>
            <a href="javascript:void(0);" class="btn mr-2" data-micromodal-trigger="modal-register-syarat">Syarat &amp; Ketentuan</a>
        </div>
        <?php $this->load->view('content/register_modal_view') ?>
      <?php endif ?>

        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div class="mt-5">
                    <ul>
                        <?php foreach ($data as $row) { ?>                            
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
        
    </div>
</div>