        </div> 
    </div>
    
    
    <!-- upload product success alert -->
    <div class="modal fade" id="productUploadAlert" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Uploaded!</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        Your product is uploaded successfully. Now sit back until someone places a bid on it.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    
    <!-- product editted success alert -->
    <div class="modal fade" id="productEditAlert" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Editted!</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        Your product is updated successfully!<br>
                        <small class="text-muted">NOTE: A product can be editted until NO bid is placed on it.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>


    <!-- delete account confirmation modal -->
    <div class="modal fade" id="confirmDeleteAccount" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account ?</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Sold enough?<br>
                        Confirm password to delete your account PERMANENTLY.

                        <hr class="my-3">

                        <form action="assets/handlers/profileEditFormHandler.php" method="POST" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" name="password" placeholder="Confirm Password">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="submit" name="deleteAccountBtn">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- account NOT deleted error message -->
    <div class="modal fade" id="accountNotDeleted" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account NOT Deleted !</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        Password NOT matched !<br>I'll suggest you not to try again and sell more. Woohoo..
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- user's short info modal box -->
    <div class="modal fade" id="userShortInfoModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <div class="input-group mb-2 userFullName">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">Name</span>
                            </div>
                            <input type="text" class="form-control bg-light" value="" readonly>
                            <div class="input-group-append">
                                <button class='btn btn-sm btn-info px-3' onclick="copyToClipboard('userFullName')" data-toggle="tooltip" title="copy to clipboard"><i class='fas fa-clipboard'></i></button>
                            </div>
                        </div>
                        
                        <div class="input-group mb-2 userEmail">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">Email</span>
                            </div>
                            <input type="text" class="form-control bg-light" value="" readonly>
                            <div class="input-group-append">
                                <button class='btn btn-sm btn-info px-3' onclick="copyToClipboard('userEmail')" data-toggle="tooltip" title="copy to clipboard"><i class='fas fa-clipboard'></i></button>
                            </div>
                        </div>

                        <div class="input-group mb-2 userPhone1">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">Primary Phone</span>
                            </div>
                            <input type="text" class="form-control bg-light" value="" readonly>
                            <div class="input-group-append">
                                <button class='btn btn-sm btn-info px-3' onclick="copyToClipboard('userPhone1')" data-toggle="tooltip" title="copy to clipboard"><i class='fas fa-clipboard'></i></button>
                            </div>
                        </div>

                        <div class="input-group mb-2 userPhone2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">Secondary Phone</span>
                            </div>
                            <input type="text" class="form-control bg-light" value="" readonly>
                            <div class="input-group-append">
                                <button class='btn btn-sm btn-info px-3' onclick="copyToClipboard('userPhone2')" data-toggle="tooltip" title="copy to clipboard"><i class='fas fa-clipboard'></i></button>
                            </div>
                        </div>

                        <small class="text-muted message"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>



   
    <!-- footer -->
    <footer>
        <div class="container-fluid text-center bg-light border-top p-2 overflow-hidden fixed-bottom border-top">
            <div class="row justify-content-center">
                <div class="col-md-5 text-md-right pr-0 mr-0">
                    Copyright &copy; 2020 <a href="https://www.linkedin.com/in/shubham-kumar-singh-a73b1217b/" class="text-decoration-none">VeNoM</a>.
                </div>
                <div class="col-md-5 text-md-left pl-0 ml-0">
                    &nbsp;All Rights Reserved
                </div>
            </div>  
        </div>
    </footer>
    
    <!-- jQuery latest version -->
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- Bootstrap JavaScripts -->
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- custom JavaScripts -->
    <script type="text/javascript" src="js/homeFunctions.js"></script>
    <script type="text/javascript" src="js/header.js"></script>
    <script type="text/javascript" src="js/browseProducts.js"></script>
    <script type="text/javascript" src="js/productUpload.js"></script>
    <script type="text/javascript" src="js/editProfile.js"></script>
    <script type="text/javascript" src="js/bids.js"></script>
    <script type="text/javascript" src="js/userInfo.js"></script>
    <script type="text/javascript" src="js/noti.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
    
    <script>
        //to show the active tab in navbar menu
        var path = window.location.pathname;        

        if(path.search("home.php") != -1){
            $("#tab1").addClass("active");
        }else if(path.search("noti.php") != -1){
            $("#tab2").addClass("active");
        }else if(path.search("myProducts.php") != -1){
            $("#tab3").addClass("active");
        }else if(path.search("myBids.php") != -1){
            $("#tab4").addClass("active");
        }else if(path.search("myProfile.php") != -1){
            $("#tab5").addClass("active");
        }


        //to show upload product success alert
        $(document).ready(function(){
            var productUploadCheck = <?php 
                                        if(isset($_SESSION['productUploadCheck'])){
                                            if($_SESSION['productUploadCheck'] == 1){
                                                echo 1;
                                            }else{
                                                echo 0;
                                            }
                                        }else{
                                            echo 0;
                                        }
                                    ?>
            
            if(productUploadCheck == 1){
                $("#productUploadAlert").modal("show");
                <?php unset($_SESSION['productUploadCheck']); ?>
            }else{
                $("#productUploadAlert").modal("hide");
            }
        });


        //to show product editted success alert
        $(document).ready(function(){
            var productEditCheck = <?php 
                                        if(isset($_SESSION['productEditCheck'])){
                                            if($_SESSION['productEditCheck'] == 1){
                                                echo 1;
                                            }else{
                                                echo 0;
                                            }
                                        }else{
                                            echo 0;
                                        }
                                    ?>
            
            if(productEditCheck == 1){
                $("#productEditAlert").modal("show");
                <?php unset($_SESSION['productEditCheck']); ?>
            }else{
                $("#productEditAlert").modal("hide");
            }
        });

        
        //to show error modal when account is not deleted
        $(document).ready(function(){
            var accountDeleteCheck = <?php
                                        if(isset($_SESSION['accountDeleteCheck'])){
                                            echo $_SESSION['accountDeleteCheck'];
                                        }else{
                                            echo -1;
                                        }
                                    ?>;
            if(accountDeleteCheck == 0){
                //switching the sidebar menu
                $(".sidebarMenu1").addClass("d-none");
                $(".sidebarMenu5").removeClass("d-none");

                //showing the profile tab
                $("#tab5").tab('show');

                //showing the error modal
                $("#accountNotDeleted").modal('show');
                <?php unset($_SESSION['accountDeleteCheck']); ?>
            }
        });
    </script>
</body>
</html>