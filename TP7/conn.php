<?php

    $hostname = "localhost";
    $username = "root";
    $password = "Zanra@2401";
    $dbname = "pembelian";

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    if (!$conn) {
        die("Koneksi Gagal");
    }