<?php

require "validate.inc";

$errors = validateName($_POST, "surename");

if (count($errors) < 1) {
    echo "Data Ok";
}
else
{
    foreach($errors as $key => $value) {
        echo $value . "<br>";
    }
}