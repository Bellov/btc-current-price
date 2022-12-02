$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.dangerAlert').hide();
  $('.notifyAlert').hide();



$('#notify').click(function () {

    let userNotifyEmail = $('#userEmail').val();
    let btcPriceToNotifyUser = $('#btcPrice').val();
        if ($(this).prop('checked')) {
            $.ajax({
                method:'POST',
                data: { notify: 1, userEmail: userNotifyEmail, btcPrice: btcPriceToNotifyUser},
                _token: '{{ csrf_token() }}',
                cache: false,
                url: '/notifyUser',
                dataType: 'json',
                success: function (data) {
                    $('.notifyAlert').show().delay(3000).fadeOut().html(data['message'])
                },
                error:function(data){
                    $('.dangerAlert').show().delay(3000).fadeOut().html(data.responseJSON.message)
                }
            })
        }
        else {
            $.ajax({
                method:'POST',
                data: { notify: 0, userEmail: userNotifyEmail},
                _token: '{{ csrf_token() }}',
                cache: false,
                url: '/unnotify',
                dataType: 'json',
                success: function (data) {
                    $('.notifyAlert').show().delay(3000).fadeOut().html(data['message'])
                },
                error:function(data){
                    $('.dangerAlert').show().delay(3000).fadeOut().html(data.responseJSON.message)
                }
            })
        }
  });
