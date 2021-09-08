<div class="box box-default">
    <div class="box-header with-border">
        <a data-module="<?php echo 'latber/add' ?>" href="<?php echo base_url('latber/add') ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah Peserta</a>
        <div class="pull-right">
            <div class="has-feedback">
                <input id="input_search" type="text" class="form-control input-sm" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
            </div>
        </div>
    </div>
    <div class="box-header with-border">
        <a href="<?php echo now_url() ?>" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
        <a href="<?php echo base_url('latber/export').get_query_string() ?>" class="btn btn-default btn-sm"><i class="fa fa-download"></i> Export to Excel</a>
        <div class="pull-right">
            <?php echo isset($paging)?$paging:'' ?>
        </div>
    </div>
    <div class="box-body no-padding">
        <div class="table-responsive no-margin">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Lengkap</th>
                        <th>No Telepon/Wa</th>
                        <th>Alamat</th>
                        <th>Kelas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                      <?php
                            $no=1+$offset;
                            foreach ($detail as $key => $value){
                      ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><a href="<?php echo base_url('latber/edit/'.$value->id); ?>"><?php echo $value->name; ?></a></td>
                        <td><?php echo $value->phone; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td><?php echo $value->class; ?></td>
                        <td><?php echo $value->status; ?></td>
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

<script type="text/javascript">
    function setstatus(t) {
        updateButton(t, true);
        $.ajax({
            url: $(t).attr("data-url"),
            type: 'POST',
            dataType: 'json',
            success: function(data) {
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr, textStatus, errorThrown) {
                sweetAlert("Oops...", "Something went wrong!", "error");
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });
    };
</script>