<script type="text/javascript" src="<?php echo config_item('assets'); ?>plugins/tinymce/js/tinymce/tinymce.min.js?v=6"></script>
<script>
$(document).ready(function(){
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: false,
        plugins: ['lists hr code photo video media paste link table'],
        relative_urls: false,
        remove_script_host: false,
        toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | table | undo redo | link | photo | video | hr | code | formatselect fontsizeselect | media',
        setup: function(editor) {
            editor.on('Change', function(e) {
                $('#content').html(tinymce.get('content').getContent());
            });
        }
    });

    $("#modal-general-iframe").on('load',function () {
        $(this).contents().find(".btn_add_photo").click(function(){
            tinymce.execCommand('mceInsertContent', false, '<img width="100%" src="'+$(this).attr('data-image')+'">');
            MicroModal.close('modal-general');
        });

        $(this).contents().find(".btn_add_video").click(function(){
            tinymce.execCommand('mceInsertContent', false, '<iframe class="video" width="100%" height="100%" src="'+$(this).attr('data-embed')+'"></iframe>');
            MicroModal.close('modal-general');
        });

    });


});


</script>