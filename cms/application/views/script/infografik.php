<script>
$(document).ready(function(){      
    $("#general-modal-iframe").on('load',function () {   
        $(this).contents().find('.btn_add_photo').click(function () {
            var src = $(this).attr('data-src');                                            
            $('#image_img').attr('src',base_domain+src);
            $('#image').val(src);    
            $('#general-modal').modal('hide');
        });
    });
});
</script>