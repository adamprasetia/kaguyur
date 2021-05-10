<script type="text/javascript" src="<?php echo config_item('assets'); ?>plugins/tinymce/js/tinymce/tinymce.min.js"></script>
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
});
</script>