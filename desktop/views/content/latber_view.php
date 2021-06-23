<div class="section py-20 bg-cover bg-no-repeat mt-10">
  <!-- section -->
  <div class="container px-5 mx-auto">
    <div class="breadcumb mb-2">
    <ul>
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="<?php echo base_url('latber') ?>">Latber</a></li>
    </ul>
    </div>
    <p>Latihan Bersama Komunitas Guppy Cianjur (KAGUYUR)</p>
    <?php if(check_verified(true)): ?>
    <div class="mt-10">    
      <a href="javascript:void(0);" class="btn btn__black mr-2" data-micromodal-trigger="modal-latber"><span style="height: 45px;display: inline-block;">DAFTARKAN&nbsp;GUPPY MU</span></a>
    </div>
    <?php $this->load->view('content/latber_modal_view') ?>         
    <?php endif ?>

    <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
      <?php $i=1;foreach ($latber as $row) { ?>        
        <div>
          <div class="tns-item tns-slide-active">
            <div data-micromodal-trigger="modal-latber<?php echo $i ?>">
              <div class="slider__etalase__img etalase__img">
                <img class="imgfillImg" src="<?php echo 'https://i1.ytimg.com/vi/'.$row->video.'/mqdefault.jpg'; ?>" alt="">
              </div>
              <div class="mt-2">
                <p style="margin-bottom:0px" class="font-bold"><?php echo $row->class ?></p>
                <!-- <small><?php echo $row->farm ?></small> -->
              </div>
            </div>
          </div>
        </div>        
      <?php $i++;} ?>
    </div>
  </div>
</div>

<?php $i=1;foreach ($latber as $row) { ?> 
<!-- [modal item belanja] -->
<div class="modal modal__dark micromodal-slide" id="modal-latber<?php echo $i ?>" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
            <div class="bg-black p-5">
                <img class="w-10" src="<?php echo config_item('assets').'images/logo2.jpg' ?>" alt="" />
            </div>
            <?php if(!empty($row->video)){ ?>
                <iframe style="width:100%;height:300px" src="https://www.youtube.com/embed/<?php echo $row->video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php } ?>
        </main>
        <footer class="modal__footer p-5">
            <form id="form_latber_vote" method="post" action="<?php echo base_url('latber/vote'); ?>">
            <input type="hidden" name="latber_id" value="<?php echo $row->id ?>">
            <button type="button" class="btn btn__black btn_action" data-idle="VOTE" data-process="Tunggu Sebentar..." data-form="#form_latber_vote" data-redirect="<?php echo current_url(); ?>">VOTE</button>
            </form>
        </footer>
    </div>
    </div>
</div>
<?php $i++;} ?>