<style type="text/css">
img {max-width: 100%;height: auto;}.item {width: 300px;min-height: 120px;max-height: 120px;float: left;margin: 3px;padding: 3px;}</style>
<div class="box">
	<div class="box-header with-border">
		<div data-module="video/upload" class="form-group pull-left">
			<a href="<?php echo base_url('video/add').get_query_string(); ?>" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add</a>
			<a href="<?php echo now_url() ?>" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
		</div>
		<div class="pull-right">
			<div class="has-feedback">
				<input id="input_search" type="text" class="form-control input-sm" placeholder="Search..." data-url="<?php echo current_url() ?>" data-query-string="<?php echo get_query_string(array('search','page')) ?>" value="<?php echo $this->input->get('search') ?>">
			</div>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<?php $i=1+$offset;foreach ($data as $row): ?>
			<div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom:10px">
				<img src="<?php echo 'https://i1.ytimg.com/vi/'.$row->id_youtube.'/mqdefault.jpg'; ?>" alt="" class="img-responsive img-thumbnail item" title="<?php echo htmlentities($row->title) ?>">
				<div style="position:absolute;top:10px;margin-left:10px">
					<?php if ($row->title): ?>
						<label class="label label-primary"><?php echo word_limiter($row->title,2) ?></label>
					<?php else: ?>
						<label class="label label-warning">No Title</label>
					<?php endif; ?>
				</div>
				<div style="position:absolute;bottom:10px;margin-left:10px">
					<a data-module="<?php echo 'video/edit' ?>" class="btn btn-default btn-xs" href="<?php echo base_url('video/edit/'.$row->id).get_query_string() ?>"><i class="fa fa-edit"></i> Edit</a>
					<?php if ($this->input->get('modals')==''): ?>
						<button data-module="<?php echo 'video/delete' ?>" class="btn btn-danger btn-xs" type="button" data-url="<?php echo base_url('video/delete/'.$row->id) ?>" name="button" onclick="return deleteData(this)" data-redirect="<?php echo base_url('video/index').get_query_string() ?>"><i class="fa fa-trash"></i> Delete</button>
					<?php else: ?>
						<button data-module="#" class="btn btn-success btn-xs btn_add_video videodata-<?php echo $row->id ?>" type="button" data-target-thumb="<?php echo $this->input->get('target_thumb') ?>" data-target-value="<?php echo $this->input->get('target_value') ?>" data-src="<?php echo $row->link ?>" data-embed="<?php echo $row->embed ?>" data-title="<?php echo $row->title; ?>" data-id="<?php echo $row->id ?>" name="button"><i class="fa fa-check"></i> Choose</button>
					<?php endif; ?>
				</div>
				<div style="position:absolute;right:10px;top:10px;margin-right:15px"></div>
			</div>
			<?php $i++;endforeach; ?>
		</div>
	</div>
	<div class="box-footer">
		<label><?php echo isset($total)?$total:'' ?></label>
		<div class="pull-right">
			<?php echo isset($paging)?$paging:'' ?>
		</div>
	</div>
</div>
