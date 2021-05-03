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
      data: $(form).serialize(),
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
        sweetAlert("Oops...", "Something went wrong!", "error");
        updateButton(t, false);
      }
    });
    
  } else {
    if (redirect) {
      window.location = redirect;
    }
  }
});

function deleteData(t) {
  swal({
      title: "Are you sure?",
      text: "You will not be able to recover this data!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function() {
      $.ajax({
        url: $(t).attr("data-url"),
        type: 'POST',
        dataType: 'json',
        success: function(data) {
          swal("Deleted!", "Your data has been deleted.", "success");
          setTimeout(function() {
            location.reload();
          }, 2000);
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log(xhr);
          console.log(textStatus);
          console.log(errorThrown);
          sweetAlert("Oops...", "Something went wrong!", "error");
          // setTimeout(function() {
          //   location.reload();
          // }, 2000);
        }
      });
    });
};

$('body').on('click', '.btn-dialog', function() {
  var title = $(this).attr('data-title');
  var src = $(this).attr('data-url');
  $('#general-modal-title').html(title);
  $('#general-modal-iframe').attr('src', src);
  $('#general-modal').modal('show');
});

$(document).on('keypress', '#input_search', function(e) {
  if (e.which == 13) {
    var url = $(this).attr('data-url');
    var queryString = $(this).attr('data-query-string');
    if (queryString) {
      url += queryString + '&search=' + $(this).val();
    } else {
      url += '?search=' + $(this).val();
    }
    window.location = url;
    return false;
  }
});

$(document).on('click', '.btn_close', function() {
  var t = $(this);
  var redirect = $(t).attr('data-redirect');

  swal({
      title: "Are you sure ?",
      text: "You have unsaved changes that will be lost!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, no problem!",
      closeOnConfirm: false
  }, function(){
    window.location = redirect;
  });
});

$("#general-modal-iframe").on('load',function () {
    $(this).contents().find('.btn_add_photo').click(function () {
        var src = $(this).attr('data-src');                                            
        console.log(src);
        $('#photo').attr('src',base_domain+src);
        $('#photo_url').val(src);
        $('#general-modal').modal('hide');
    });
});

</script>