<script>
$(document).ready(function(){
    tinymce.init({
        selector: '#content',
        height: 1000,
        menubar: false,
        plugins: ['lists hr code photocms videocms media paste link table'],
        relative_urls: false,
        remove_script_host: false,
        toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | table | undo redo | link | photocms | videocms | hr | code | formatselect fontsizeselect | media',
        setup: function(editor) {
            editor.on('Change', function(e) {
                $('#content').html(tinymce.get('content').getContent());
            });
        }
    });

    $("#general-modal-iframe").on('load',function () {
        var title = $('#general-modal-title').html();
        $(this).contents().find(".btn_add_photo").click(function(){
            if(title == 'Add Photo'){
                var id = $(this).attr('data-id');
                var id_tinymce = $(this).attr('data-id-tinymce');
                var imagedata = $("#general-modal-iframe").contents().find('.imagedata-'+id).data();
                tinymce.get(id_tinymce).execCommand('mceInsertContent', false, '<img width="100%" src="'+base_domain+imagedata.src+'">');
            }else if(title == 'Pilih Cover'){
                var src = $(this).attr('data-src');                                            
                $('#image_img').attr('src',base_domain+src);
                $('#image').val(src);    
            }
            $('#general-modal').modal('hide');
        });

        $(this).contents().find(".btn_add_video").click(function(){
            var id = $(this).attr('data-id');
            var videodata = $("#general-modal-iframe").contents().find('.videodata-'+id).data();
            console.log(videodata);
            tinymce.execCommand('mceInsertContent', false, '<iframe class="video" width="100%" height="100%" src="'+videodata.embed+'"></iframe>');
            $('#general-modal').modal('hide');
        });
    });
});
</script>