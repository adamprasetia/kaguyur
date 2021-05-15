<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <h1 class="font-bold uppercase">INFOGRAFIK</h1>
        <div class="grid grid-flow-row grid-rows-1 grid-cols-2 md:grid-cols-5 md:grid-rows-1 gap-4 my-5">
        <?php foreach ($infografik as $row) { ?>        
            <a href="javascript:void(0)" data-micromodal-trigger="modal-infografik-<?php echo $row->id ?>">
                <div class="tns-item tns-slide-active">            
                    <div class="slider__etalase__img etalase__img">
                    <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'300x300') ?>" alt="<?php echo htmlentities($row->title) ?>">
                    </div>
                    <div>
                    <p style="margin-bottom:0px" class="font-bold"><?php echo $row->title ?></p>
                    </div>            
                </div>
            </a>
        <?php } ?>
        </div>
    </div>
</div>

<!-- [modal-infografik] -->
<?php foreach ($infografik as $row) { ?>
<div class="modal modal__dark micromodal-slide" id="modal-infografik-<?php echo $row->id ?>" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container modal__container__fix" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <img src="<?php echo base_url($row->image) ?>" alt=""/>
            </main>
            <footer class="modal__footer"></footer>
        </div>
    </div>
</div>
<?php } ?>
