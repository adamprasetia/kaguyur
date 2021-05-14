<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <h1 class="font-bold uppercase">INFOGRAFIK</h1>
        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div class="mt-5">
                    <ul>
                        <?php foreach ($infografik as $row) { ?>                            
                        <li class="grid grid-cols-8 gap-4 mb-5 slider__square__img" data-micromodal-trigger="modal-infografik-<?php echo $row->id ?>">
                            <!-- <a href="javascript:void(0)" data-micromodal-trigger="modal-infografik-<?php echo $row->id ?>"> -->
                            <div class="col-span-3 md:col-span-2">
                                <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'300x300') ?>" alt="<?php echo htmlentities($row->title) ?>" />
                            </div>
                            <div class="col-span-5 md:col-span-6">
                                <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                                <p class="text-sm text__wrap3"><?php echo format_dmy($row->created_date) ?></p>
                            </div>
                            <!-- </a> -->
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
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
