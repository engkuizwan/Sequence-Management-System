$('.buttonsaveajax').click(function(event) {
    // alert('test');
    var message1 
    var message3 
    var form = $(this).parents('form');

    if($(this).data('message1') == null){
      message1 = 'Are you sure?';
    }else{
      message1 = $(this).data('message1');
    }

    if($(this).data('message3') == null){
      message3 = 'Success?';
    }else{
      message3 = $(this).data('message3');
    }

    var message2 = $(this).data('message2');

    event.preventDefault();
    Swal.fire({
        title: message1,
        text: message2,
        icon: 'warning',
        showDenyButton: true,
        confirmButtonColor: '#3085d6',
        denyButtonColor: '#d33',
        denyButtonText: 'No',
        confirmButtonText: 'Yes',
        reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
          form.submit();
      }
    });
});

$('.buttonsaveajax2').click(function(event) {
  // alert('test');
  var message1 
  var message3 
  var form = $(this).parents('form');

  if($(this).data('message1') == null){
    message1 = 'Are you sure?';
  }else{
    message1 = $(this).data('message1');
  }

  if($(this).data('message3') == null){
    message3 = 'Success?';
  }else{
    message3 = $(this).data('message3');
  }

  var message2 = $(this).data('message2');

  event.preventDefault();
  $.ajax({
      url: form.attr('action'),
      type: 'POST',
      data: form.serialize(),
      success: function(response) {
        // show the success message
        
        // reload the page after a short delay
        setTimeout(function() {
          // location.reload();
          read(id);
        }, 2000);
      },
      error: function(xhr) {
        // show an error message
        Swal.fire(
          'Error',
          'The form could not be submitted',
          'error'
        );
        
        // re-enable the button
        $(this).attr('disabled', false);
      }
    });
});



$('.buttondeleteajax').click(function(event) {
  // alert('test');
  var message1 
    var message3 
    var form = $(this).parents('form');

    if($(this).data('message1') == null){
      message1 = 'Are you sure?';
    }else{
      message1 = $(this).data('message1');
    }

    if($(this).data('message3') == null){
      message3 = 'Success?';
    }else{
      message3 = $(this).data('message3');
    }

    var id = $(this).data('id');

    var message2 = $(this).data('message2');
  var form = $(this).parents('form');
  event.preventDefault();
  Swal.fire({
      title: message1,
      text: message2,
      icon: 'warning',
      showDenyButton: true,
      confirmButtonColor: '#3085d6',
      denyButtonColor: '#d33',
      denyButtonText: 'No',
      confirmButtonText: 'Yes',
      reverseButtons: true
  }).then((result) => {
      if (result.isConfirmed) {
      // disable the button to prevent multiple clicks
      $(this).attr('disabled', true);
      
      // submit the form using AJAX
      $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
          // show the success message
          Swal.fire(
            'Successfull',
            'Project have been moved to archive',
            'success'
          );
          
          // reload the page after a short delay
          setTimeout(function() {
            // location.reload();
            read(id);
          }, 2000);
        },
        error: function(xhr) {
          // show an error message
          Swal.fire(
            'Error',
            'The form could not be submitted',
            'error'
          );
          
          // re-enable the button
          $(this).attr('disabled', false);
        }
      });
      } else if (result.isDenied) {
          Swal.fire(
          'Tindakan Dibatalkan',
          'Tiada tindakan dilakukan',
          'error'
          )
      }
  })
});