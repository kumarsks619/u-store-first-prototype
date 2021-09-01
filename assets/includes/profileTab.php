<div class="wrapper">
    <div class="profile-wrapper mx-auto mt-4">
        <div class="card text-center border-0">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="card mb-3 w-100 mx-3">
                        <div class="row no-gutters">
                            <div class="col-md-4 order-lg-2">
                                <div class="avatar text-center pt-3 pb-2" style="background-color: #f2f2f2;">
                                    <img src="<?php echo $avatarLink; ?>" class="img-fluid rounded" height=120 width=120>
                                    <h5 class="mb-0">@<?php echo $username; ?></h5>
                                    <p class="text-muted mt-0 mb-0"><?php echo $firstName . " " . $lastName; ?></p>
                                </div>
                            </div>
                            <div class="col-md-8 order-lg-1">
                                <div class="card-body">
                                    <h5 class="card-title">My College</h5>
                                    <p class="card-text my-0"><?php echo $collegeName; ?></p>
                                    <p class="card-text text-muted mb-lg-5"><?php echo $collegeCity; ?>, <?php echo $collegeState; ?></p>
                                    <button class="btn btn-danger" id="deleteAccountBtn" data-toggle="modal" data-target="#confirmDeleteAccount">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- first name -->
                        <form autocomplete="off">
                            <div class="input-group mb-3" id="editFirstName">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">First Name</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $firstName; ?>" readonly>
                                <div class="input-group-append editBtnDiv">
                                    <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                                </div>
                                <div class="input-group-append d-none actionBtns">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success doneBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <!-- last name -->
                        <form autocomplete="off">
                            <div class="input-group mb-3" id="editLastName">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">Last Name</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $lastName; ?>" readonly>
                                <div class="input-group-append editBtnDiv">
                                    <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                                </div>
                                <div class="input-group-append d-none actionBtns">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success doneBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <!-- email -->
                        <form autocomplete="off">
                            <div class="input-group mb-3" id="editEmail">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">Email</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $email; ?>" readonly>
                                <div class="input-group-append editBtnDiv">
                                    <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                                </div>
                                <div class="input-group-append d-none actionBtns">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success doneBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <!-- primary phone number -->
                        <form autocomplete="off">
                            <div class="input-group mb-3" id="editPhone1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">Primary Phone</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $phone1; ?>" maxlength="10" readonly>
                                <div class="input-group-append editBtnDiv">
                                    <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                                </div>
                                <div class="input-group-append d-none actionBtns">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success doneBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <!-- secondary phone number -->
                        <form autocomplete="off">
                            <div class="input-group mb-3" id="editPhone2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-info text-white">Secondary Phone</span>
                                </div>
                                <input type="text" class="form-control" value="<?php echo $phone2; ?>" maxlength="10" readonly>
                                <div class="input-group-append editBtnDiv">
                                    <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                                </div>
                                <div class="input-group-append d-none actionBtns">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success doneBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row" id="oldPassword">
                    <div class="col-12">
                        <!-- password -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">Password</span>
                            </div>
                            <input type="password" class="form-control" value="user's password" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-info editBtn" type="button"><i class="fas fa-pen"></i></button>
                            </div>
                        </div>
                        <?php 
                            if(isset($_SESSION['changePwMsg'])){
                                echo $_SESSION['changePwMsg'];
                                unset($_SESSION['changePwMsg']);
                            } 
                        ?>
                    </div>
                </div>

                <!-- change password -->
                <form id="changePassword" action="assets/handlers/profileEditFormHandler.php" method="POST" autocomplete="off" style="display: none;">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group mb-3" id="newPw1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="New password">
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group mb-3" id="newPw2">
                                <input type="password" class="form-control" placeholder="Confirm new password" name="newPw">
                                <div class="input-group-append editPwVisibilityToggle" data-toggle="tooltip" title="show / hide">
                                    <!-- password visibility toggle -->
                                    <label class="input-group-text" for="editPwVisibility"><i class="fas fa-eye-slash"></i></label>
                                    <input type="checkbox" id="editPwVisibility" hidden>
                                </div>
                                <div class="invalid-feedback text-center"></div>
                                <div class="valid-feedback text-center"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group mb-3" id="currentPw">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="currentPw" placeholder="Current password">
                                <div class="input-group-append">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-success doneBtn" id="changePwBtn" name="changePwBtn" disabled><i class="fas fa-check"></i></button>
                                        <button type="button" class="btn btn-danger cancelBtn"><i class="fas fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer border-top-0 bg-white">
                <small class="text-muted">refresh page to reflect changes.</small>
            </div>
        </div>
    </div>
</div>

<br><br><br>
