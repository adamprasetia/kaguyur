<div class="box box-default">
    <div class="box-header with-border">
        <a data-module="<?php echo 'infografik/add' ?>" href="<?php echo base_url('infografik/add') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Infografik</a>
        <div class="pull-right">
            <div class="has-feedback">
                <input id="input_search" type="text" class="form-control input-sm" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
            </div>
        </div>
    </div>
    <div class="box-header with-border">
        <a href="<?php echo now_url() ?>" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
        <div class="pull-right">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Judul</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                            $no=1+$offset;
                            foreach ($detail as $key => $value){
                      ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href="<?php echo base_url('infografik/edit/'.$value->id.'/'.$value->status); ?>"><?php echo $value->title; ?></a></td>
                    </tr>
                      <?php $no++; } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box-footer">
        <label><?php echo isset($total)?$total:'' ?></label>
        <div class="pull-right">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
    </div>
</div>
