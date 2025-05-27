<!-- Modal -->
<div class="modal fade" id="read-user-feedback-modal" tabindex="-1" role="dialog" aria-labelledby="top-navbar-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p id="read-user-feedback"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="restricted-area-modal" tabindex="-1" role="dialog" aria-labelledby="restricted-area-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">RESTRICTED AREA</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="restricted-area-form" method="POST">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <label for="phone">Phone number</label>
                            <input type="text" placeholder="07...." autocomplete="off" name="phone" id="phone" pattern="[0-9]{10}" class="form-control shadow-sm" required="required"
                            title="Only ten numbers required.">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-md float-lg-end form-submission-btn">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="top-navbar-modal" tabindex="-1" role="dialog" aria-labelledby="top-navbar-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-start" id="" style="text-align: left;">ADD NAVBAR DETAILS</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="top-navbar-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <label for="top-position">Select Position</label>
                            <select name="top-position" id="top-position" class="form-select-lg form-control" required="required">
                                <option value=""></option>
                                <option value="left">Left</option>
                                <option value="center">Center</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-5" id="display-top-navbar-logo-field">
                        <div class="col-lg-12">
                            <label for="logo">Select Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/png, image/svg+xml">
                        </div>
                    </div>
                    <div class="form-group row mb-5" id="display-top-navbar-text-field">
                        <div class="col-lg-12">
                            <label for="center-text">TEXT</label>
                            <textarea name="center-text" id="center-text" autocomplete="off" cols="3" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-md float-lg-end form-submission-btn">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="slider-section-modal" tabindex="-1" role="dialog" aria-labelledby="top-navbar-modal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-start" id="" style="text-align: left;">SLIDER SECTION DETAILS</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="slider-navbar-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <label for="slider-position">Select Position</label>
                            <select name="position" id="position" class="form-select-lg form-control" required="required">
                                <option value=""></option>
                                <option value="profile">Profile</option>
                                <option value="carousel">Carousel</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-lg-12">
                            <label for="profile">Select Image</label>
                            <input type="file" name="profile" id="profile" class="form-control" accept="image/png, image/jpg, image/jpeg">
                        </div>
                    </div>
                    <div id="display-profile-field">
                        <div class="form-group row mb-3">
                            <div class="col-lg-12">
                                <label for="profile-title">Title</label>
                                <input type="text" autocomplete="off" name="profile-title" id="profile-title" placeholder="Title" class="form-control" pattern="[a-zA-Z]{3,}" title="At least three characters should be supplied.">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <div class="col-lg-12">
                                <label for="profile-name">Full Name</label>
                                <input type="text" autocomplete="off" name="profile-name" id="profile-name" placeholder="Full Name" class="form-control" pattern="[a-zA-Z.\s]{3,}" title="At least three characters should be supplied.">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-md float-lg-end form-submission-btn">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="content-section-modal" tabindex="-1" role="dialog" aria-labelledby="content-section-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-start" id="" style="text-align: left;">CONTENT SECTION DETAILS</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="content-section-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-lg-12">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-select-lg form-control" required="required">
                                <option value=""></option>
                                <option value="habari">Habari</option>
                                <option value="taarifa">Taarifa</option>
                                <option value="matukio">Matukio</option>
                                <option value="video">Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-lg-12">
                            <label for="content-title">Title</label>
                            <textarea name="content-title" id="content-title" cols="3" rows="1" class="form-control" required="required"
                            placeholder="Content Title"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-lg-12">
                            <label for="short-description">Short Description</label>
                            <textarea name="short-description" id="short-description"  cols="5" rows="2" class="form-control" required="required"
                            placeholder="Short Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-lg-12">
                            <label for="content-description">Description</label>
                            <textarea name="content-description" id="content-description" cols="10" rows="5" class="form-control" required="required"
                            placeholder="Content Description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-lg-12">
                            <label for="attachment-type">Attachment Type</label>
                            <select name="attachment-type" id="attachment-type" class="form-select-lg form-control" required="required">
                                <option value=""></option>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                                <option value="document">Document</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-5">
                        <div class="col-lg-12">
                            <label for="content-attachment">Select Attachment</label>
                            <input type="file" name="content-attachment" id="content-attachment" class="form-control" accept="video/mp4, image/jpeg, image/jpg, application/pdf">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-md float-lg-end form-submission-btn">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="pages-content-section-modal" tabindex="-1" role="dialog" aria-labelledby="content-section-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-start" id="" style="text-align: left;">PAGE CONTENT SECTION DETAILS</h5>
            </div>
            <div class="modal-body">
                <form action="#" id="pages-content-section-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <label for="category-page">Select Page</label>
                            <select name="category" id="category-page" class="form-select-lg form-control" required="required" style="width:100%;">
                                <option value=""></option>
                                <option value="about">About Us</option>
                                <option value="vision">Vision & Mission</option>
                                <option value="members">Council Members</option>
                                <option value="team">Management Team</option>
                                <option value="traditional-citizen">Traditional Citizen</option>
                                <option value="traditional-noncitizen">Traditional NonCitizen</option>
                                <option value="alternatively-citizen">Alternatively Citizen</option>
                                <option value="alternatively-noncitizen">Alternatively NonCitizen</option>
                                <option value="massage-citizen">Massage Citizen</option>
                                <option value="medicine-seller">Medicine Seller</option>
                                <option value="assistant-alternative">Assistant Alternative</option>
                                <option value="assistant-traditional">Assistant Traditional</option>
                                <option value="traditional-medicine-shrine">Traditional Medicine Shrine</option>
                                <option value="traditional-medicine-clinic">Traditional Medicine Clinic</option>
                                <option value="alternatively-medicine-clinic">Alternatively Medicine Clinic</option>
                                <option value="traditional-health-centre">Traditional Health Centre</option>
                                <option value="alternative-health-centre">Alternative Health Centre</option>
                                <option value="traditional-medicine-hospital">Traditional Medicine Hospital</option>
                                <option value="alternative-medicine-hospital">Alternative Medicine Hospital</option>
                                <option value="traditional-medicine-store">Traditional Medicine Store</option>
                                <option value="traditional-medicine-registration">Traditional Medicine Registration</option>
                                <option value="alternative-medicine-registration">Alternative Medicine Registration</option>
                                <option value="enlisting-traditional-medicine">Enlisting Traditional Medicine</option>
                                <option value="importing-medicine">Importing Medicine</option>
                                <option value="exporting-medicine">Exporting Medicine</option>
                            </select>
                        </div>
                    </div>
                    <div id="other-page-component-style">
                        <div class="form-group row mb-5">
                            <div class="col-lg-12">
                                <label for="content-description">Description</label>
                                <textarea name="content-description" id="content-description" cols="10" rows="5" class="form-control"
                                          placeholder="Content goes here"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="council-member-style">
                        <div class="form-group row mb-3">
                            <div class="col-lg-12">
                                <label for="user-title">Title</label>
                                <input type="text" autocomplete="off" name="user-title" id="user-title" placeholder="Title" class="form-control" pattern="[a-zA-Z.\s]{3,}" title="At least three characters should be supplied.">
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <div class="col-lg-12">
                                <label for="user-full-name">Full Name</label>
                                <input type="text" autocomplete="off" name="user-full-name" id="user-full-name" placeholder="Full Name" class="form-control" pattern="[a-zA-Z.\s]{3,}" title="At least three characters should be supplied.">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-lg-12">
                                <label for="attachment-type">Attachment Type</label>
                                <select name="attachment-type" id="attachment-type" class="form-select-lg form-control" required="required">
                                    <option value="image">Image</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-5">
                            <div class="col-lg-12">
                                <label for="content-attachment">Select Attachment</label>
                                <input type="file" name="content-attachment" id="content-attachment" class="form-control" accept="image/jpeg, image/jpg">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-info btn-md float-lg-end form-submission-btn">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
