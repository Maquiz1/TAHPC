<script>
$(document).ready(function () {

    setInterval(function(){
        checkSessionStatus();
    },1000);

    topNavbarCallBack();
    sliderSectionCallBack();
    contentSectionCallBack();
    contactUsCallBack();
    $('#category-page').select2({
        dropdownParent: $('#pages-content-section-modal') // 👈 important for dropdown to render inside modal
    });
});


function processLink(link){
    let linkName = link.id;
    if(linkName === 'remove-top-navbar-data-link'){
        let elementId = $(link).data('topnavid');
        if(elementId !== ''){
            let option = confirm('Are you sure you want to delete selected details?');
            if(option){
                const route = "{{route('remove-top-navbar-data')}}";
                const section = 'top-navbar';
                const name = 'top_navbar';

                removeData(route, elementId,section,name)
            }
        }
    }else if(linkName === 'remove-slider-data-link'){
        let elementId = $(link).data('sliderid');

        if(elementId !== ''){
            let option = confirm('Are you sure you want to delete selected details?');
            if(option){
                const route = "{{route('remove-top-navbar-data')}}";
                const section = 'slider';
                const name = "slider_section";

                removeData(route, elementId,section,name);
            }
        }
    }else if(linkName === 'remove-content-section-data-link'){
        let elementId = $(link).data('contentdata');

        if(elementId !== ''){
            let option = confirm('Are you sure you want to delete selected details?');
            if(option){
                const route = "{{route('remove-top-navbar-data')}}";
                const section = 'content';
                const name = "habari_mpya";

                removeData(route, elementId,section,name);
            }
        }
    }else if(linkName === 'remove-feedback-section-data-link'){
        let elementId = $(link).data('contentdata');

        if(elementId !== ''){
            let option = confirm('Are you sure you want to delete selected details?');
            if(option){
                const route = "{{route('remove-top-navbar-data')}}";
                const section = 'contact-us';
                const name = "contact_us";

                removeData(route, elementId,section,name);
            }
        }
    }else if(linkName === 'read-content-section-data-link'){
        let elementId = $(link).data('readata');

        if(elementId !== ''){
            const route = "{{route('read-feedback')}}";
            const htmlElementTag = "read-user-feedback";

            displayHtmlData(route, elementId, htmlElementTag);
        }
    }
}


//form that handles pages content
$('#pages-content-section-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: '{{ route("pages-content-route") }}', // Replace with your route
        type: 'POST',
        data: formData,
        processData: false, // Don't process the files
        contentType: false, // Don't set contentType
        beforeSend: function () {
            $('.form-submission-btn').attr('disabled', true);
            $('.form-submission-btn').html('Processing...');
        },
        success: function (response) {
            $('.form-submission-btn').attr('disabled', false);
            $('.form-submission-btn').html('SUBMIT');
            const results = JSON.parse(response);

            if(response.indexOf('success') >=0){
                $('#content-section-modal').modal('hide');
                $('#pages-content-section-form').trigger('reset');
                notificationCallBack(response,results);
                contentSectionCallBack();
            }else{
                notificationCallBack(response,results);
            }
        },
        error: function (xhr, status, error) {
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
});

$('#category-page').on('change', function (e) {
    let name = this.value;
    if (name !== '') {
        if (name === 'members' || name === 'team') {
            $('#other-page-component-style').hide('slow');
            $('#council-member-style').show('slow');
        }else{
            $('#other-page-component-style').show('slow');
            $('#council-member-style').hide('slow');
        }
    }
});

//slider section details call back
function contactUsCallBack(){
    const route = "{{route('get-feedback-route')}}";
    const htmlElementTag = "display-contact-us-details";
    const elementKey = '';

    displayHtmlData(route, elementKey, htmlElementTag);

    const route1 = "{{route('feedback-count')}}";
    const htmlElementTag1 = "display-counter";
    displayCount(route1, elementKey, htmlElementTag1);
}

//slider section details call back
function contentSectionCallBack(){
    const route = "{{route('get-content-section-route')}}";

    const htmlElementTag = "display-content-section-data";
    const elementKey = '';

    displayHtmlData(route, elementKey, htmlElementTag);

    const route1 = "{{route('feedback-count')}}";
    const htmlElementTag1 = "display-counter";
    displayCount(route1, elementKey, htmlElementTag1);
}


//form that handle content section form
$('#content-section-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: '{{ route("content-section-route") }}', // Replace with your route
        type: 'POST',
        data: formData,
        processData: false, // Don't process the files
        contentType: false, // Don't set contentType
        beforeSend: function () {
            $('.form-submission-btn').attr('disabled', true);
            $('.form-submission-btn').html('Processing...');
        },
        success: function (response) {
            $('.form-submission-btn').attr('disabled', false);
            $('.form-submission-btn').html('SUBMIT');
            const results = JSON.parse(response);

            if(response.indexOf('success') >=0){
                $('#content-section-modal').modal('hide');
                $('#content-section-form').trigger('reset');
                notificationCallBack(response,results);
                contentSectionCallBack();
            }else{
                notificationCallBack(response,results);
            }
        },
        error: function (xhr, status, error) {
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
});


//slider section details call back
function sliderSectionCallBack(){
    const route = "{{route('slider-callback-route')}}";
    const htmlElementTag = "display-slider-section-details";
    const elementKey = '';

    displayHtmlData(route, elementKey, htmlElementTag);
}

//form that handle top navbar details
$('#slider-navbar-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: '{{ route("slider-route") }}', // Replace with your route
        type: 'POST',
        data: formData,
        processData: false, // Don't process the files
        contentType: false, // Don't set contentType
        beforeSend: function () {
            $('.form-submission-btn').attr('disabled', true);
            $('.form-submission-btn').html('Processing...');
        },
        success: function (response) {
            $('.form-submission-btn').attr('disabled', false);
            $('.form-submission-btn').html('SUBMIT');
            const results = JSON.parse(response);

            if(response.indexOf('success') >=0){
                $('#slider-navbar-form').trigger('reset');
                $('#display-profile-field').hide('slow');
                notificationCallBack(response,results);
                sliderSectionCallBack();
            }else{
                notificationCallBack(response,results);
            }
        },
        error: function (xhr, status, error) {
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
});

//top navbar details call back
function topNavbarCallBack(){
    const route = "{{route('top-navbar-callback')}}";
    const htmlElementTag = "display-top-navbar-details";
    const elementKey = '';

    displayHtmlData(route, elementKey, htmlElementTag);
}

//form that handle top navbar details
$('#top-navbar-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: '{{ route("navbar-route") }}', // Replace with your route
        type: 'POST',
        data: formData,
        processData: false, // Don't process the files
        contentType: false, // Don't set contentType
        beforeSend: function () {
            $('.form-submission-btn').attr('disabled', true);
            $('.form-submission-btn').html('Processing...');
        },
        success: function (response) {
            $('.form-submission-btn').attr('disabled', false);
            $('.form-submission-btn').html('SUBMIT');
            const results = JSON.parse(response);

            if(response.indexOf('success') >=0){
                $('#top-navbar-modal').modal('hide');
                $('#top-navbar-form').trigger('reset');
                $('#display-top-navbar-text-field').hide('slow');
                $('#display-top-navbar-logo-field').hide('slow');
                notificationCallBack(response,results);
                topNavbarCallBack();
            }else{
                notificationCallBack(response,results);
            }
        },
        error: function (xhr, status, error) {
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
            $('.form-submission-btn').html('SUBMIT');
            if (response.indexOf('success') >= 0) {
                localStorage.setItem('initial-authenticated', 'true');
                window.open("{{ route('login') }}", "_blank");
            }else{
                localStorage.removeItem('initial-authenticated');
                document.location.reload();
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

$('#top-position').on('change', function(){
    const options = this.value;
    if (options === 'left' || options === 'right') {
        $('#display-top-navbar-text-field').hide('slow');
        $('#display-top-navbar-logo-field').show('slow');
    }else if (options === 'center'){
        $('#display-top-navbar-text-field').show('slow');
        $('#display-top-navbar-logo-field').hide('slow');
    }else{
        $('#display-top-navbar-text-field').hide('slow');
        $('#display-top-navbar-logo-field').hide('slow');
    }
});

$('#position').on('change', function(){
    const options = this.value;
    if (options === 'profile'){
        $('#display-profile-field').show('slow');
    }else{
        $('#display-profile-field').hide('slow');
    }
});

//function that sign out account
function signOutAccount() {
    logOutAccount();
}

//notification call back function
function notificationCallBack(response,results){
    if (response.indexOf('error')>=0){
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass":"toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "10000",
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
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr["success"](results.success);
    }
}

function logOutAccount(){
    $.ajax({
        url:"{{route('log-out')}}",
        method:"POST",
        data:{"_token":"{{csrf_token()}}"},
        beforeSend(){
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass":"toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": false,
                "hideDuration": "1000",
                "timeOut": false,
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["info"]('Just a minute...');
        },
        success:function(response){
            document.location.href = "{{route('login')}}";
        },
        error: function (xhr, status, error) {
            // Handle error response here
            try {
                let response = JSON.parse(xhr.responseText);
                let errorMessage = response.message;
                alert(errorMessage);
            } catch (e) {
                // Handle JSON parsing error
                console.error('Error parsing JSON response:', e);
            }
        }
    })
}

// Function to check the session status based on the session cookie
function checkSessionStatus() {

    const sessionExpiration = new Date(document.cookie.replace(/(?:(?:^|.*;\s*)session_expiration\s*\=\s*([^;]*).*$)|^.*$/, '$1'));

    if (sessionExpiration < new Date()) {
        // Session has expired; log the user out or take necessary action
        // alert("Your session has expired. Please log in to start a new session.");
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({ headers: {'X-CSRF-TOKEN': csrfToken } });

        $.ajax({
            url:"{{route('log-out')}}",
            method:"POST",
            data:{"_token":"{{csrf_token()}}","session_timeout":"session time out"},
            success:function(response){
                // Store data in localStorage for informing user about session expired
                localStorage.setItem('session_expired_key', 'You have been automatically logged out due to inactivity of 120 seconds. Login to start a new session.');
                document.location.href = "{{route('login')}}";
            },
            error: function (xhr, status, error) {
                // Handle error response here
                try {
                    let response = JSON.parse(xhr.responseText);
                    let errorMessage = response.message;
                    alert(errorMessage);
                } catch (e) {
                    // Handle JSON parsing error
                    console.error('Error parsing JSON response:', e);
                }
            }
        })
    }else{
        //remove session expired key
        localStorage.removeItem('session_expired_key');
    }
}

// Function to reset the session expiration when user interacts with the system
function resetSessionExpiration() {
    // Call this function when user activity is detected, such as a click or interaction with your application
    // Update the session expiration cookie
    const sessionLifetime = 60; // 1 minute
    const expirationTime  = new Date(Date.now() + sessionLifetime * 60 * 1000); // Convert minutes to milliseconds

    document.cookie = `session_expiration=${expirationTime.toUTCString()}; path=/;`;
}

// Attach event listeners for user interaction (e.g., clicks)
document.addEventListener('click', resetSessionExpiration);

document.addEventListener('keydown', resetSessionExpiration);

function displayHtmlData(route, elementKey, htmlElementTag) {
    $.ajax({
        url: route,
        method: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "elementKey": elementKey,
        },
        delay: 250,
        beforeSend(){
            $('#' + htmlElementTag).html('Processing...');
        },
        success: function(response) {
            if (htmlElementTag === 'read-user-feedback'){
                contactUsCallBack();
            }
            $('#' + htmlElementTag).html(response);
        },
        error: function(xhr, status, error) {
            $('#' + htmlElementTag).html('');
            try {
                let response = JSON.parse(xhr.responseText);
                let errorMessage = response.message;
                alert(errorMessage);
            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        }
    });
}

function displayCount(route, elementKey, htmlElementTag) {
    $.ajax({
        url: route,
        method: "GET",
        data: {
            "_token": "{{ csrf_token() }}",
            "elementKey": elementKey,
        },
        delay: 250,
        success: function(response) {
            $('#' + htmlElementTag).html(response);
        },
        error: function(xhr, status, error) {
            $('#' + htmlElementTag).html('');
            try {
                let response = JSON.parse(xhr.responseText);
                let errorMessage = response.message;
                alert(errorMessage);
            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        }
    });
}

//function that remove data
function removeData(route, elementKey, section, name) {
    $.ajax({
        url: route,
        method: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "elementKey": elementKey,
            "elementKey1": name
        },
        delay: 250,
        success: function(response) {
            let results = JSON.parse(response);
            notificationCallBack(response,results);
            if(section === 'top-navbar'){
                topNavbarCallBack();
            }else if(section === 'slider'){
                sliderSectionCallBack();
            }else if(section === 'content'){
                contentSectionCallBack();
            }else if(section === 'contact-us'){
                contactUsCallBack();
            }
        },
        error: function(xhr, status, error) {
            try {
                let response = JSON.parse(xhr.responseText);
                let errorMessage = response.message;
                alert(errorMessage);
            } catch (e) {
                console.error('Error parsing JSON response:', e);
            }
        }
    });
}

const activePage = window.location.pathname;
const links = document.querySelectorAll('.menu-item a');

for (let i = 0; i < links.length; i++) {
    links[i].classList.remove('is-active');
    if (links[i].href.includes(activePage)) {
        let menuItem = links[i].closest('.menu-item');
        menuItem.classList.add('is-active');
    }
}
</script>
