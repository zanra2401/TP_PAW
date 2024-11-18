<?php
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
    foreach ($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
    echo "<br>";
    $height = array(
        "Andy" => "176", 
        "Barry" => "165", 
        "Charlie" => "170",
        "Zanuar" => "173",
        "Rikza" => "169",
        "Aditiya" => "172",
        "sopo" => "175",
        "jarwo" => "170" 
    );

    # tidak perlu merubah foreach karena foreach akan berulang sebanyak panjang array secara otomatis
    foreach ($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
    echo "<br>";
    $weight = array(
        "Andy" => "60",
        "Barry" => "70",
        "Charlie" => "65"
    );

    # hanya perlu merubah dari $height ke $weight, untuk menentukan array mana yang akan di loop
    foreach ($weight as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
    