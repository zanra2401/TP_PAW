<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "store";

    $connection = mysqli_connect($hostname, $username, $password, $dbname);

    if (!$connection) {
        die("Koneksi Gagal!");
    }


    function getSuppliers() {
        $sql = "SELECT * FROM supplier";
        $result = mysqli_query($sql);

        return fetch_assoc($result);
    }