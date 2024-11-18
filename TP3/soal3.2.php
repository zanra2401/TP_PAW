<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");

    $arrlength = count($fruits);

    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }

    for($x = 0; $x < 5; $x++){
        array_push($fruits, "fruit");
    }

    # saya hanya perlu menimpa arrlength tanpa harus merubah struktur for
    $arrlength = count($fruits);
    echo "<hr>";
    echo "Dengan data baru <br>";
    echo "<hr>";
    for($x = 0; $x < $arrlength; $x++) {
        echo $fruits[$x];
        echo "<br>";
    }

    # saya hanya perlu menimpa arrlength tanpa harus merubah struktur forss
    $veggies = array("Cabbage", "Broccoli", "Cucumber");

    $arrlength = count($veggies);

    echo "<hr>";
    echo "Veggies<br>";
    echo "<hr>";
    for($x = 0; $x < $arrlength; $x++) {
        echo $veggies[$x];
        echo "<br>";
    }