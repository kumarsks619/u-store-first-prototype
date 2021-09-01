<form id="productUploadForm" action="assets/handlers/productUploadFormHandler.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    <div class="form-row mt-2">
        <!-- product name -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-gift"></i></span>
                </div>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" maxlength="50" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- product description -->
        <div class="col mb-3"> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                </div>
                <textarea class="form-control" id="productDesc" name="productDesc" placeholder="Brief description of product (more details about product)." maxlength="200"></textarea>
            </div>                 
        </div>
    </div>
    <div class="form-row">
        <!-- product photo -->
        <div class="col-lg-8 mb-3" id="productPhotoCol"> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="productPhoto" name="productPhoto" required>
                    <label class="custom-file-label text-truncate" id="fileLabel">A picture of product</label>
                </div>
            </div>
            <!-- upload progress bar -->
            <div class="progress" id="uploadProgressBar" style="height: 8px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"></div>
            </div>
            <div class="custom-valid-feedback text-center" style="font-size: 0.85rem; color: green;"></div>
            <div class="custom-invalid-feedback text-center" style="font-size: 0.85rem; color: red;"></div>
            <div class="invalid-feedback text-center"></div>
        </div>
        <!-- product price -->
        <div class="col-lg-4"> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
                </div>
                <input type="number" class="form-control" placeholder="Price" id="productPrice" name="productPrice" min="0" max="50000" required>
            </div>                
        </div>
    </div>
    

    <hr class="my-3">

    <!-- submit & close buttons -->
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <button class="btn btn-success btn-block" id="productUploadBtn" name="productUploadBtn" type="submit">Upload</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>