<script>
$(document).ready(function(){      
    $("#general-modal-iframe").on('load',function () {   
        var title = $('#general-modal-title').html();
        $(this).contents().find('.btn_add_photo').click(function () {
            var src = $(this).attr('data-src');                                            
            if(title == 'Pilih untuk Cover'){
                $('#cover_img').attr('src',base_domain+src);
                $('#cover').val(src);    
            }
            $('#general-modal').modal('hide');
        });
        $(this).contents().find('.btn_add_photo').click(function () {
            var src = $(this).attr('data-src');                                            
            if(title == 'Pilih untuk Photo'){
                $('.photo-wrap').prepend('<div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom:10px">'
                +'<img src="'+base_domain+src+'" alt="" style="background-color:#ffdab3" class="img-responsive img-thumbnail item" title="">'
                +'<div style="position:absolute;bottom:10px;margin-left:10px">'
                +'<input type="hidden" name="photo[]" value="'+src+'">'
                +'<button class="btn btn-danger btn-xs btn_delete_photo" type="button" name="button" onclick="delete_photo(this)"><i class="fa fa-trash"></i> Hapus</button>'
                +'</div></div>')
                console.log('sini');
                // $('#cover_img').attr('src',base_domain+src);
                // $('#cover').val(src);    
            }
            $('#general-modal').modal('hide');
        });
    });
});

function delete_photo(t){
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
    },
    function(s) {
        $(t).parent().parent().remove();
    });
}

</script>