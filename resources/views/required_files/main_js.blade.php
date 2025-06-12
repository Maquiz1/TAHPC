<script>
    $(document).ready(function () {
        if (!localStorage.getItem('initial-authenticated')){
            window.location.href = "{{route('welcome')}}";
        }

        $(".megamenu").on("click", function(e) {
            e.stopPropagation();
        });
    })
    //





    function setSessionCookie() {
        const sessionLifetime = 60; // 1 minute
        const expirationTime  = new Date(Date.now() + sessionLifetime * 60 * 1000); // Convert minutes to milliseconds

        document.cookie = `session_expiration=${expirationTime.toUTCString()}; path=/`;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login-form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:"{{route('auth-user')}}",
            method:"POST",
            data:$('#login-form').serialize(),
            xhrFields: {
                withCredentials: true
            },
            delay:250,
            beforeSend(){
                $('#login-btn').attr('disabled',true);
                $('#login-btn').html('Processing...');
            },
            success:function(response){
                $('#login-btn').attr('disabled',false);
                $('#login-btn').html('SUBMIT');
                let results = JSON.parse(response);

                if(response.indexOf('success')>=0){
                    setSessionCookie();
                    notificationCallBack(response,results);
                    setTimeout(function() {
                        document.location.href = '{{route('dashboard')}}';
                    },300);
                }else{
                    notificationCallBack(response,results);
                }
            },
            error: function (xhr, status, error) {
                // Handle error response here
                $('#login-btn').attr('disabled',false);
                $('#login-btn').html('SUBMIT');
                try {
                    let response = JSON.parse(xhr.responseText);
                    let errorMessage = response.message;

                    if(errorMessage === 'CSRF token mismatch.'){
                        document.location.reload()
                    }else{
                        alert(errorMessage);
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                }
            }
        })
    });

    function notificationCallBack(response,results){
        if (response.indexOf('error')>=0){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass":"toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "9000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["error"](results.error);
        }else{
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass":"toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"](results.success);
        }
    }


</script>
