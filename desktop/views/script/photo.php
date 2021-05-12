<script>
$(document).ready(function(){
    $('#send-question').click(function(){
        $('#photo').trigger('click');
    })
    $('#photo').change(function() {
        if(this.files[0].size > 1024000){
            swal({
            title: 'Terjadi Kesalahan',
            type: 'error',
            text: 'Ukuran file tidak boleh lebih dari 1 MB',
            timer: 2000,
            showConfirmButton: false
            });

            this.value = '';   
        }else{
            action($(this))
        }
    });
});
</script>