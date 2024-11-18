<?php

    $buah1 = ["mangga", "manggis"];
    $buah2 = ["Jeruk", "Jambu"];
    $nilai = [
        "A" => 100,
        "C" => 80,
        "B" => 90,
    ];
    $arr1 = [10, 2, 9, 8, 7];
    $assoc1 = [
        "b" => 100,
        "a" => 90,
        "c" => 70
    ];


    # array push
    echo "<hr> Array Push <hr>";
    array_push($buah1, "ceri"); # menambah data di belakang array
    print_r($buah1);
    echo "<br>";


    # array merge
    echo "<hr> array merge <hr>";
    $buah3 = array_merge($buah1, $buah2); # menggabungkan 2 atau llebih array
    print_r($buah3);
    echo "<br>";

    # array values
    echo "<hr> array values <hr>";
    print_r(array_values($nilai));
    echo "<br>";        

    # array search
    echo "<hr> array search <hr>";
    $arrB = array_search("mangga", $buah1);
    $arrA = array_search(100, $nilai);
    echo $arrB;
    echo "<br>";
    echo $arrA;
    echo "<br>";

    # array filter
    echo "<hr> array filter  <hr>";
    $genap = array_filter($nilai, function ($element) {
        return $element > 80;
    });

    print_r($genap);
    echo "<br>";

    # array sorting
    echo "<hr> array sorting <hr>";
    sort($arr1);
    print_r($arr1);
    echo "<br>";
    rsort($arr1);
    print_r($arr1);
    echo "<br>";
    asort($assoc1);
    print_r($assoc1);
    echo "<br>";
    ksort($assoc1);
    print_r($assoc1);
    echo "<br>";