<?php

    # PREG MATCH
    
    echo "<b>---Preg Match---</b><br>";
    $pattern = "/^[a-z]$/"; # hanya cocok saat string hanya mengandung a-z

    if (preg_match($pattern, "abc")) {
        echo "COCOK" . "<br>";
    }
    else 
    {
        echo "tidak cocok" . "<br>";
    }

    # STRING
    echo "<b>----STRING----</b><br>";
    $tes_variable = "halo          halo";
    $new_str = trim($tes_variable);
    echo $new_str . "<br>";
    $tes_variable = "HALOO DUNIA";
    echo $tes_variable . "<br>";
    $new_str = strtolower($tes_variable);
    echo $new_str . "<br>";
    $tes_variable = "halo dunia";
    echo $tes_variable . "<br>";
    $new_str = strtoupper($tes_variable);
    echo $new_str .  "<br>";

    
    
    
    # FILTER
    echo "<b>----FILTER----</b><br>";
    $tes_variable = "<h1>Hallo Dunia</h1>";
    echo $tes_variable;
    $new_str = filter_var($tes_variable, FILTER_SANITIZE_STRING);
    echo $new_str . "<br>";
    echo "<hr>";
    $tes_variable = 100;
    echo $tes_variable . "<br>";
    $new_str = filter_var($tes_variable, FILTER_VALIDATE_INT);
    echo $new_str . "<br>";
    echo "<hr>";
    $tes_variable = "192.168.1.1";
    echo $tes_variable . "<br>";
    $new_str = filter_var($tes_variable, FILTER_VALIDATE_IP);
    echo $new_str . "<br>";
    echo "<hr>";
    $tes_variable = "anjay@gmail.com";
    echo $tes_variable . "<br>";
    $new_str = filter_var($tes_variable, FILTER_VALIDATE_EMAIL);
    echo $new_str . "<br>";
    echo "<hr>";
    $tes_variable = "https://www.w3schools.com";
    echo $tes_variable . "<br>";
    $new_str = filter_var($tes_variable, FILTER_VALIDATE_URL);
    echo $new_str . "<br>";
    echo filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL);
    echo "<hr>";
    
    # TYPE TESTTING
    echo "<b>----TYPE TESTTING----</b><br>";
    echo is_float(20.5) . "<br>";
    echo is_int(20) . "<br>";
    echo is_numeric("2000") . "<br>";
    echo is_string("halo dunia") . "<br>";

    # DATA
    echo "<b>----DATE----</b><br>";
    var_dump(checkdate(2, 29, 2001));