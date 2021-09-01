<form id="signUpForm" action="assets/handlers/signUpFormHandler.php" method="POST" autocomplete="off">
    <div class="form-row mt-2">
        <!-- first name -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                </div>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
        <!-- last name -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- username -->
        <div class="col-md-7 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input type="text" class="form-control" id="usernameSignUp" name="username" placeholder="Create an Unique Username" maxlength="30">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
        <!-- avatar -->
        <div class="col-md-5 mb-3">
            <div class="dropdown" id="selectAvatar">
                <button class="btn btn-outline-secondary btn-block dropdown-toggle" id="avatarBtn" type="button" data-toggle="dropdown">
                     Select an Avatar
                </button>
                <div class="text-center" id="avatarFeedback"></div>
                <div class="dropdown-menu" id="avatarDropdown" style="height: 200px; width: 100%; overflow: auto;">
                    <?php include('avatarsList.php'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- email -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email ID">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- primary phone number -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                </div>
                <input type="phone" class="form-control" id="phone1" name="phone1" placeholder="Phone No. Primary" maxlength="10">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
        <!-- secondary phone number -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="phone" class="form-control" id="phone2" name="phone2" placeholder="Phone No. Secondary" maxlength="10" disabled>
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- college state -->
        <div class="col-md-6 mb-3">
            <div class="input-group" style="max-height: 400px;">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                </div>
                <select class="custom-select mr-sm-2" id="selectState" name="collegeState" style="overflow-x: auto;" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                    <option selected disabled>College State</option>
                    <?php include('statesList.php'); ?>
                </select>
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
        <!-- college city -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-crosshairs"></i></span>
                </div>
                <select class="custom-select mr-sm-2" id="selectCity" name="collegeCity" style="overflow-x: auto;" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                    <option selected disabled value="0">College City</option>
                </select>
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- college name -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                </div>
                <select class="custom-select mr-sm-2" id="selectCollege" name="collegeName" style="overflow-x: auto;" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' disabled>
                    <option selected disabled value="0">College Name</option>
                </select>
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
            <div class="text-center" id="collegeNameMsg"><small class="text-muted">Can't find your College? Please <a href="#contactUsModal" data-dismiss="modal" data-toggle="modal" class="alert-link">Contact Us</a>.</small></div>
        </div>
    </div>
    <div class="form-row">
        <!-- password -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="password1" name="password1" placeholder="Create Password" maxlength="32">
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>            
            </div>
        </div>
        <!-- confirm password -->
        <div class="col-md-6 mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" maxlength="32">
                <div class="input-group-append signUpPwVisibilityToggle" data-toggle="tooltip" title="show / hide">
                    <!-- password visibility toggle -->
                    <label class="input-group-text" for="signUpPwVisibility"><i class="fas fa-eye-slash"></i></label>
                    <input type="checkbox" id="signUpPwVisibility" hidden>
                </div>
                <div class="valid-feedback text-center"></div>
                <div class="invalid-feedback text-center"></div>
            </div>
        </div>
    </div>

    
    <hr class="my-3">

    <!-- submit & close buttons -->
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <button class="btn btn-success btn-block" id="signUp" name="signUp" type="submit" disabled>Sign Up</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary btn-block" id="signUpCloseBtn" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>