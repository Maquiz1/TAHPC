@extends('layouts.website-layout')
@section('main-content')
    <div class="container" id="more-details">
        <div class="row mt-5">
            <div class="col-lg-12">
                <h4>CONTACT US</h4>
                <hr>

                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div id="display-alert-message">

                            </div>
                            <div class="contact-wrapper">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <div class="contact-info h-100">
                                            <h3 class="mb-4">Get in touch</h3>
                                            <p class="mb-4">We'd love to hear from you. Please fill out the form or contact us using the information below.</p>

                                            <div class="contact-item">
                                                <div class="contact-icon">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Address</h6>
                                                    <p class="mb-0">
                                                        S.L.P 743 Dodoma,
                                                        Wizara ya Afya<br>Dodoma, Tanzania</p>
                                                </div>
                                            </div>

                                            <div class="contact-item">
                                                <div class="contact-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Phone</h6>
                                                    <p class="mb-0"> +255-26-2323267/5 </p>
                                                </div>
                                            </div>

                                            <div class="contact-item">
                                                <div class="contact-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Email</h6>
                                                    <p class="mb-0">ps@afya.go.tz</p>
                                                </div>
                                            </div>

                                            <div class="social-links">
                                                <h6 class="mb-3">Follow Us</h6>
                                                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="contact-form">
                                            <h3 class="mb-4">Send us a message</h3>
                                            <form method="POST" id="process-contact-form" name="process-contact-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" required name="contact-fname" class="form-control" placeholder="Firstname" pattern="[a-zA-Z]{3,}" title="At least three characters should be supplied.">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" required name="contact-lname" class="form-control" placeholder="Lastname" pattern="[a-zA-Z]{3,}" title="At least three characters should be supplied.">
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" required name="contact-email" class="form-control" placeholder="example@gmail.com">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Subject</label>
                                                    <input type="text" required name="contact-subject" class="form-control" placeholder="How can we help?" pattern="[a-zA-Z\s]{3,}" title="At least three characters should be supplied.">
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Message</label>
                                                    <textarea class="form-control" required name="contact-message" rows="2"  placeholder="Your message here..."></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-submit text-white form-submission-btn">Send Message</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
