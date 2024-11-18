<?php
    require "validate.inc";

    $errors = [];
    if (isset($_POST["submit"])) {
        $error_surename = validateName($_POST, "surename");
        $error_email = validateEmail($_POST, "email");
        $error_password = validatePassword($_POST, "password");
        $error_steert_address = validateStreetAddress($_POST, "street_address");
        $error_jenis_kelamin = validateJenisKelamin($_POST, "gender");
        $error_hobi = validateHobi($_POST, "hobi");
        $error_state = validateState($_POST, "state");

    
        $errors = array_merge($error_surename, $error_email, $error_password, $error_steert_address, $error_jenis_kelamin, $error_hobi, $error_state);
    }

    if (count($errors) > 0 or !isset($_POST["submit"])) {

        foreach($errors as $error) {
?>
            <div style="width: 500px; margin-bottom: 20px; font-family: arial; background: blue; border-radius: 4px; padding: 20px; color: white; font-weight: 900;">

                <?php
                    echo $error;
                ?>

            </div>
<?php            
        }
    } else {
?>
        <div style="width: 500px; font-family: arial; background: blue; border-radius: 4px; padding: 20px; color: white; font-weight: 900;">
            Form submitted successfully with no errors
        </div>
<?php        
    }
?>