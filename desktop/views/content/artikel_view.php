<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <div class="breadcumb">
            <ul>
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li><a href="<?php echo base_url('artikel') ?>">Artikel</a></li>
            </ul>
        </div>
        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <div class="mt-5">
                    <ul>
                        <?php foreach ($article as $row) { ?>                            
                        <li class="grid grid-cols-8 gap-4 mb-5">
                            <div class="col-span-3 md:col-span-2">
                                <img class="imgfillImg" src="<?php echo gen_thumb($row->image,'300x300') ?>" alt="" />
                            </div>
                            <div class="col-span-5 md:col-span-6">
                                <a href="<?php echo base_url('artikel/'.$row->id.'/'.url_title($row->title,'-',true))?>">
                                    <h4 class="mb-2 text__wrap2"><?php echo $row->title ?></h4>
                                    <p class="text-sm text__wrap3"><?php echo $row->description ?></p>
                                    <p class="text-sm text__wrap3"><?php echo format_dmy($row->published_date) ?></p>
                                </a>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php $this->load->view('content/artikel_gate_view') ?>
            </div>
        </div>
    </div>
</div>