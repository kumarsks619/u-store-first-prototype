<form id="loginForm" action="assets/handlers/loginFormHandler.php" method="POST" autocomplete="off">
    <div class="form-row mt-2">
        <!-- username -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input type="text" class="form-control" id="usernameLogin" name="usernameLogin" placeholder="Username" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- password -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <div class="input-group-append loginPwVisibilityToggle" data-toggle="tooltip" title="show / hide">
                    <!-- password visibility toggle -->
                    <label class="input-group-text" for="loginPwVisibility"><i class="fas fa-eye-slash"></i></label>
                    <input type="checkbox" id="loginPwVisibility" hidden>
                </div>
            </div>
        </div>
    </div>
    <!-- remember me -->
    <div class="form-row">
        <div class="col">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="rememberMe" name="rememberMe" value="1">
                <label class="custom-control-label" for="rememberMe">Keep me logged in.</label>
            </div>
        </div>
    </div>

    <hr class="my-3">

    <!-- submit & close buttons -->
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <input class="btn btn-success btn-block" id="login" name="login" type="submit" value="Login">
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
        </div>
    </div>    
</form>
