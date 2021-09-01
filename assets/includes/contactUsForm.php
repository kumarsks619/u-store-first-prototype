<form id="contactUsForm" action="assets/handlers/contactUsFormHandler.php" method="POST" autocomplete="off">
    <p class="text-muted px-1">
        Please let us know if we have missed you college somehow or any other bug you came across.
        We'll figure it out ASAP!
    </p>
    <div class="form-row mt-2">
        <!-- mailer full name -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="nameContactUs" name="nameContactUs" placeholder="Full Name" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- email -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" class="form-control" id="emailContactUs" name="emailContactUs" placeholder="Email" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- message subject -->
        <div class="col mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
                </div>
                <input type="text" class="form-control" id="subjectContactUs" name="subjectContactUs" placeholder="Subject" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <!-- message -->
        <div class="col mb-3"> 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                </div>
                <textarea class="form-control" id="messageContactUs" name="messageContactUs" placeholder="Your message for us..." maxlength="500" required></textarea>
            </div>                 
        </div>
    </div>

    <hr class="my-3">

    <!-- submit & close buttons -->
    <div class="form-row">
        <div class="col-md-6 mb-2">
            <input class="btn btn-info btn-block" id="sendContactUs" name="sendContactUs" type="submit" value="Send">
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
        </div>
    </div>    
</form>
