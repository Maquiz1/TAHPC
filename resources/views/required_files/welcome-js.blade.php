<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            }
        });
    });

    $('#process-contact-form').on('submit', function (e) {
        e.preventDefault();

        const route = '{{route('contact-form')}}';
        const method = 'POST';
        const formName = 'process-contact-form';

        FormSubmission(this, route, method, formName);
    });

    //function that handle restricted area form
    $('#restricted-area-form').on('submit', function(e){
        e.preventDefault();

        const route = '{{route('validate-user')}}';
        const method = 'POST';
        const formName = 'restrict-area-form';

        FormSubmission(this, route, method, formName);
    });

    function FormSubmission(formElement, route, method, formName) {
        // Serialize form data
        let formData = $(formElement).serialize();
        $.ajax({
            url: route,
            method: method,
            data: formData,
            beforeSend() {
                $('.form-submission-btn').attr('disabled', true);
                $('.form-submission-btn').html('Processing...');
            },
            success: function(response) {
                $('.form-submission-btn').attr('disabled', false);
                let results = JSON.parse(response);
                if (formName === 'process-contact-form') {
                    $('.form-submission-btn').html('Send Message');
                    $('#process-contact-form').trigger('reset');
                    if (response.indexOf('success') >= 0) {
                        $('#display-alert-message').html(
                            '<div class="alert alert-success" role="alert">' +
                            results.success +
                            '</div>'
                        );
                    }else{
                        $('#display-alert-message').html(
                            '<div class="alert alert-warning" role="alert">' +
                            results.error +
                            '</div>'
                        );
                    }
                }else{
                    $('.form-submission-btn').html('SUBMIT');
                    if (response.indexOf('success') >= 0) {
                        localStorage.setItem('initial-authenticated', 'true');
                        window.open("{{ route('login') }}", "_blank");
                    }else{
                        localStorage.removeItem('initial-authenticated');
                        document.location.reload();
                    }
                }

            },
            error: function(xhr, status, error) {
                $('.form-submission-btn').attr('disabled', false);
                $('.form-submission-btn').html('SUBMIT');
                if (typeof onError === "function") {
                    console.log(xhr, status, error);
                } else {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        let errorMessage = response.message;
                        alert(errorMessage);
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                }
            }
        });
    }

    function scrollCarousel(direction) {
        const carousel = document.getElementById('videoCarousel');
        const scrollAmount = 320; // width + margin
        carousel.scrollBy({
            left: scrollAmount * direction,
            behavior: 'smooth'
        });
    }
</script>
