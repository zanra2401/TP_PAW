<?php
    $matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
    $praktikum = ["JARKOM", "PAW"];

    foreach ($matkul as $mat)
    {
        if (in_array($mat, $praktikum)) 
        {
            echo "saya sedang mengambil matkul " . $mat . " beserta praktikumnya<br>";
        } 
        elseif ($mat == "PSBF" or $mat == "RPL")
        {
            echo "saya belum mengambil matkul " . $mat . "<br>";
        }else {
            echo "saya sudah mengambil matkul " . $mat . " semester lalu<br>";
        }
    }

    