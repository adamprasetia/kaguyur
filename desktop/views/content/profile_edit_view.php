<div class="section py-20 bg-cover bg-no-repeat mt-10">
    <!-- section -->
    <div class="container px-5 mx-auto">
    <h1 class="font-bold uppercase">PROFIL</h1>
    <div class="text-sm">
          <form method="post" id="form_data" action="<?php echo base_url('profile/update') ?>">
            <div class="mb-3">
              <label class="font-semibold block">Nama Farm</label>
              <input class="field w-full" type="text" name="farm" id="farm" value="<?php echo isset($profile->farm)?$profile->farm:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Nama Lengkap</label>
              <input class="field w-full" type="text" name="name" id="name" value="<?php echo isset($profile->name)?$profile->name:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Alamat</label>
              <textarea class="field w-full" name="address" cols="30" rows="10"><?php echo isset($profile->address)?$profile->address:''; ?></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Mulai Budidaya Sejak</label>
              <input class="field w-full" type="text" name="start" id="start" value="<?php echo isset($profile->start)?$profile->start:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">No Telepon/Wa</label>
              <input class="field w-full" type="text" name="phone" id="phone" value="<?php echo isset($profile->phone)?$profile->phone:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Strain Guppy</label>
              <textarea class="field w-full" name="strain" cols="30" rows="10" placeholder="Black moscow, AFR, Blue Grass ..."><?php echo isset($profile->strain)?$profile->strain:''; ?></textarea>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Pas Foto</label>
              <?php if(!empty($profile->photo)): ?>
              <img src="<?php echo isset($profile->photo)?base_url($profile->photo):''; ?>" class="media-object" style="width: 200px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              <?php endif ?>
              <input type="file" name="photo" id="photo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block fp__">Logo</label>
              <?php if(!empty($profile->logo)): ?>
              <img src="<?php echo isset($profile->logo)?base_url($profile->logo):''; ?>" class="media-object" style="width: 200px;height: auto;border-radius: 10px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              <?php endif ?>
              <input type="file" name="logo" id="logo" accept="image/jpeg, image/png" class="field w-full"/>
            </div>
            <strong class="pt-5 block">Link Media Sosial</strong>
            <div class="mb-3">
              <label class="font-semibold block">Facebook</label>
              <input type="text" name="fb" id="fb" class="field w-full" value="<?php echo isset($profile->fb)?$profile->fb:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Instagram</label>
              <input type="text" name="ig" id="ig" class="field w-full" value="<?php echo isset($profile->ig)?$profile->ig:''; ?>"/>
            </div>
            <div class="mb-3">
              <label class="font-semibold block">Twitter</label>
              <input type="text" name="tw" id="tw" class="field w-full" value="<?php echo isset($profile->tw)?$profile->tw:''; ?>"/>
            </div>
            <div class="flex items-center justify-center my-5">
                <button type="button" class="btn btn__black btn_action" id="btn_simpan" data-idle="SIMPAN" data-process="Saving..." data-form="#form_data" data-redirect="<?php echo current_url(); ?>">SIMPAN</button>
                &nbsp;
                <a href="<?php echo base_url('profile') ?>" class="btn btn__black">KEMBALI</a>
            </div>
          </form>
        </div>
    </div>
</div>

<script src="<?php echo config_item('assets').'plugins/sweetalert/js/sweetalert.min.js'; ?>"></script>
<script>
    $(document).ready(function()
{
	$('form').submit(function(e) {
		e.preventDefault();
	});

	function updateButton(t, status) {
		if (!status) {
			$(t).html($(t).attr('data-idle'));
			$(t).prop('disabled', false);
			$('#overlay').attr('class','');
			$('#text').remove();
		} else {
			$(t).html($(t).attr('data-process'));
			$(t).prop('disabled', true);
			$('#overlay').addClass('backdrop__ backdrop__in');
			$('#overlay').append('<div id="text"><i class="iconrefresh fa fa-refresh fa-spin"></i></div>');
		}
	}

	$("#btn_daftar").click(function()
	{
		var t = $(this);
		var form = $(this).attr('data-form');
		var action = $(this).attr('data-action');
		var redirect = $(this).attr('data-redirect');
		$.ajax({
			url: action,
			method:'post',
			data: new FormData($(form)[0]),
			processData: false,
			contentType: false,
			beforeSend: function() {
				updateButton(t,true);
			},
			success:function(str){
				var obj = jQuery.parseJSON(str);
				var tipe  = 'success';
				var title = 'Success!';
				var message = 'Your data has been successfully';

				if (obj.tipe != undefined) {
					tipe = obj.tipe;
				}
				if (obj.title != undefined) {
					title = obj.title;
				}
				if (obj.message != undefined) {
					message = obj.message;
				}

        swal({
          title: title,
          type: tipe,
          text: message,
          timer: 2000,
          showConfirmButton: false
        });

        if(obj.tipe !='error'){

          if (redirect) {
            setTimeout(function() {
              window.location = redirect;
            }, 2000);
          }

        }

        updateButton(t, false);
			},
			error: function(xhr, textStatus, errorThrown){
				sweetAlert("Oops...", "Something went wrong!", "error");
				updateButton(t,false);
			}
		});
	});
});
</script>

