<?php
    require "conn.php";     

    $id_barang = $_GET['id'];

    $query = "SELECT * FROM transaksi_detail WHERE barang_id = $id_barang";

    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
        echo "<script>alert('barang tidak dapat di hapus karena di gunakan di transaksi detail')
        window.location.href = 'index.php'</script>";
    } else {
        mysqli_query($conn, "DELETE FROM barang WHERE id = $id_barang");
        header("Location: index.php");
    }