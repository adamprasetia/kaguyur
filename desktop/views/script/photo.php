<script>
$(document).ready(function(){
    $('#send-question').click(function(){
        $('#photo').trigger('click');
    })
    $('#photo').change(function() {
        action($(this))
    });
});
</script>