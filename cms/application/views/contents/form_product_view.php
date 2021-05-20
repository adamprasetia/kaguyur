<div class="box box-default">
  <div class="box-header with-border"><?php echo isset($title)?$title:''?></div>
  <div class="box-body with-border">        
    <form id="form_data" action="<?php echo $action ?>">
    <div class="form-group">
      <input type="hidden" id="input_id" name="input_id" value="<?php echo isset($data->id)?$data->id:'' ?>">
      <label>Judul Produk *</label>
      <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($data->name)?$data->name:''; ?>">
    </div>
    <div class="form-group">
      <label>Deskripsi *</label>
      <textarea name="description" class="form-control" id="description" cols="30" rows="10"><?php echo isset($data->description)?$data->description:''; ?></textarea>
    </div>
    <div class="form-group">
      <label>Harga *</label>
      <input type="number" id="price" name="price" class="form-control" value="<?php echo isset($data->price)?$data->price:''; ?>">
    </div>
    <div class="form-group">
      <label>Kategori *</label>
      <select name="category" id="category" class="form-control">
        <option value="IKAN GUPPY" <?php echo isset($data->category) && $data->category=='IKAN GUPPY'?'selected':''?>>IKAN GUPPY</option>
        <option value="PERALATAN & AKSESORI" <?php echo isset($data->category) && $data->category=='PERALATAN & AKSESORI'?'selected':''?>>PERALATAN & AKSESORI</option>
        <option value="PAKAN & OBAT" <?php echo isset($data->category) && $data->category=='PAKAN & OBAT'?'selected':''?>>PAKAN & OBAT</option>
      </select>
    </div>
    <div class="form-group">
      <label>Stok *</label>
      <input type="number" id="stock" name="stock" class="form-control" value="<?php echo isset($data->stock)?$data->stock:''; ?>">
    </div>
    <div class="form-group">
      <label>Photo</label>
      <br/>
      <a href="javascript:void(0)" class="btn btn-default btn-sm btn-dialog" data-title="Pilih untuk Photo" data-url="<?php echo base_url('photo').'?modals=true'; ?>"><i class="fa fa-plus"></i> Tambah Photo</a>
    </div>
    <div class="form-group">
        <div class="row photo-wrap">
            <?php 
            if(!empty($data->photo)){
            $photo = json_decode($data->photo);
            foreach ($photo as $row) { ?>                
            <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom:10px">
                <img src="<?php echo config_item('base_domain').$row ?>" alt="" style="background-color:#ffdab3" class="img-responsive img-thumbnail item" title="">
                <div style="position:absolute;bottom:10px;margin-left:10px">
                    <input type="hidden" name="photo[]" value="<?php echo $row ?>">
                    <button class="btn btn-danger btn-xs btn_delete_photo" type="button" name="button" onclick="delete_photo(this)"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
    <div class="form-group">
      <label>Status *</label>
      <select name="status" id="status" class="form-control">
        <option value="ACTIVE" <?php echo isset($data->status) && $data->status=='ACTIVE'?'selected':''?>>ACTIVE</option>
        <option value="NOT ACTIVE" <?php echo isset($data->status) && $data->status=='NOT ACTIVE'?'selected':''?>>NOT ACTIVE</option>
        <option value="DELETED" <?php echo isset($data->status) && $data->status=='DELETED'?'selected':''?>>DELETED</option>
      </select>
    </div>
    </form>
  </div>
  <div class="box-footer">
    <button type="button" class="btn_action btn btn-sm btn-warning" data-idle="<i class='fa fa-save'></i> Save" data-form="#form_data" data-process="Saving..." data-redirect="<?php echo base_url('product/index').get_query_string() ?>"><i class="fa fa-send"></i> Save</button>
    <button type="button" class="btn_close btn btn-sm btn-default" data-idle="Close" data-process="Closing..." data-redirect="<?php echo base_url('product/index').get_query_string() ?>"><i class="fa fa-close"></i> Close</button>
  </div>
</div>
<?php $this->load->view('script/product') ?>