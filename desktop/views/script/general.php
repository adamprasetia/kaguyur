<script>
// Method or Function
function updateButton(t, status) {
  if (!status) {
    $(t).html($(t).attr('data-idle'));
    $(t).prop('disabled', false);
    $('.overlay').remove();
  } else {
    $(t).html($(t).attr('data-process'));
    $(t).prop('disabled', true);
    $('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  }
}

function htmlEntities(str) {
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
// Event Listener
$('form').submit(function(e) {
  e.preventDefault();
});

$(document).on('click', '.btn_action', function() {
  var form = $(this).attr('data-form');
  var action = $(form).attr('action');
  var redirect = $(this).attr('data-redirect');
  var t = $(this);
  if (action) {
    $.ajax({
      url: action,
      method: 'post',
      data: new FormData($(form)[0]),
      processData: false,
      contentType: false,
      dataType: 'json',
      beforeSend: function() {
        updateButton(t, true);
      },
      success: function(obj) {
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
      error: function(xhr, textStatus, errorThrown) {
        sweetAlert("Oops...", "Terjadi Kesalahan!", "error");
        updateButton(t, false);
      }
    });
    
  } else {
    if (redirect) {
      window.location = redirect;
    }
  }
});
</script>