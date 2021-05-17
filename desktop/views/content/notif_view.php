<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
        <div class="breadcumb mb-2">
            <ul>
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url('notifikasi') ?>">Notifikasi</a></li>
            </ul>
        </div>
        <div class="grid grid-cols-6 gap-10">
            <div class="col-span-6 md:col-span-3">
                <?php if(!empty($data)): ?>
                <div class="mt-5">
                    <ul>
                        <?php $i=0;foreach ($data as $row) { ?>                            
                        <li class="grid grid-cols-12 gap-4 mb-5">
                            <div class="col-span-5 md:col-span-6">
                                <a href="<?php echo base_url('notifikasi/open/'.$i.'?url='.$row->action) ?>">
                                    <h4 class="mb-2 <?php echo $row->status==0?'font-bold':'' ?> text__wrap2"><?php echo $row->message ?></h4>
                                    <p class="text-sm text__wrap3"><?php echo format_dmy($row->created_date) ?></p>
                                </a>
                            </div>
                        </li>
                        <?php $i++;} ?>
                    </ul>
                </div>
                <?php else: ?>
                <p>Tidak Ada Notifikasi</p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>