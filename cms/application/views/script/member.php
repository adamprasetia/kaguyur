<script>
$(document).ready(function(){      
    $("#general-modal-iframe").on('load',function () {   
        var title = $('#general-modal-title').html();
        $(this).contents().find('.btn_add_photo').click(function () {
            var src = $(this).attr('data-src');                                            
            console.log(src);
            console.log(title);
            if(title == 'Pilih untuk pas foto'){
                $('#photo_img').attr('src',base_domain+src);
                $('#photo').val(src);    
            }
            if(title == 'Pilih untuk logo'){
                $('#logo_img').attr('src',base_domain+src);
                $('#logo').val(src);    
            }
            $('#general-modal').modal('hide');
        });
    });
});
  
</script>