<div class="avatar text-center pt-3 pb-2" style="background-color: #f2f2f2;">
    <img src="<?php echo $avatarLink; ?>" class="img-fluid rounded" height=120 width=120>
    <h5 class="mb-0">@<?php echo $username; ?></h5>
    <p class="text-muted mt-0 mb-0"><?php echo $firstName . " " . $lastName; ?></p>
    <form action="assets/handlers/logoutHandler.php" method="POST">
        <button class="btn btn-danger" type="submit" name="logout">Logout</button>
    </form>
</div>