(function () {
    'use strict';

    /*---------------------------
            Form submit and  copy url
    ------------------------------*/

$('.requestform').on('submit', function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var basicbtnhtml=$('.basicbtn').html();
    showLoader();
    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function() {
            $('.basicbtn').html('<div class="spinner-border text-light spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Please Wait....');
            $('.basicbtn').attr('disabled','');
        },
        success: function (response) {
            hideLoader();
            $('.basicbtn').removeAttr('disabled')
            $('.basicbtn').html(basicbtnhtml)
            if(response.error)
            {
                return Sweet('error', response.error);
            }
            var route = $('#url').val() + response;
            var qrCodeUrl = 'https://chart.googleapis.com/chart?cht=qr&chl=' + encodeURIComponent(route) + '&chs=120x120';
            $('#route').val(route)
            Swal.fire({
            title: 'Request Link Created',
            html: '<img src="' + qrCodeUrl + '" alt="QR Code">',
            input: 'text',
            inputValue: route,
            confirmButtonText: `Copy`,
            icon: 'success',
            showCancelButton: true,
            customClass: {
                input: 'customroute',
            },
            }).then((result) => {
                if (result.value)  {
                    var range = document.createRange();
                    range.selectNode(document.querySelector(".customroute"));
                    window.getSelection().removeAllRanges(); // clear current selection
                    window.getSelection().addRange(range);
                    document.execCommand("copy");
                    Sweet('success', 'Copied!')
                }
            })
        },
        error: function(xhr, status, error)
        {
            hideLoader();
            $('.basicbtn').removeAttr('disabled');
            $('.basicbtn').html(basicbtnhtml);

            $.each(xhr.responseJSON.errors, function (key, item)
            {
                Sweet('error',item)
                $("#errors").html("<li class='text-danger'>"+item+"</li>")
            });
        }
    });
})

    $("#customer").on("change",function () {
        let val = $(this).find(':selected').data('id');
        if (val!==undefined){
            $('#customer_phone').prop('readonly', true);
            $('#customer_name').prop('readonly', true);
            $("#customer_phone").val(val.phone_no);
            $("#customer_name").val(val.customer_name);
        }else{
            $('#customer_phone').prop('readonly', false);
            $('#customer_name').prop('readonly', false);
            $('#customer_name').val('');
            $('#customer_phone').val('');
        }
    })

    var preload = document.getElementById('loading');
    function hideLoader()
    {
        preload.style.display = "none";
    }

    function showLoader()
    {
        preload.style.display = "block";
    }
})();
