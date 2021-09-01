<?php
    //dummy avatar if no selection is made
    echo "<div class='dropdown-item invisible' style='height: 1px;'>
            <div class='custom-control custom-radio'>
                <input type='radio' class='custom-control-input' id='avatar0' name='avatarRadio' value='0' checked hidden>
                <label class='custom-control-label' for='avatar0'>
                    <img src=''>
                </label>
            </div>
        </div>";
        
    for($i = 1; $i <= 16; $i++){
        $avatar = "avatar" . $i;
        echo "<div class='dropdown-item'>
                    <div class='custom-control custom-radio'>
                        <input type='radio' class='custom-control-input' id='$avatar' name='avatarRadio' value='$i'>
                        <label class='custom-control-label' for='$avatar'>
                            <img src='assets/img/avatars/$avatar.png' alt='$avatar'>
                        </label>
                    </div>
               </div>";
        echo "<hr>";
    }
?>