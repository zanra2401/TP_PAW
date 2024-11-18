<?php

require "conn.php";

if (isset($_GET["id_transaksi"])) {
	$query = "DELETE FROM transaksi_detail WHERE transaksi_id = {$_GET['id_transaksi']}";
	mysqli_query($conn, $query);
	$query = "DELETE FROM transaksi WHERE id = {$_GET['id_transaksi']}";
	mysqli_query($conn, $query);
	header("Location: index.php");
}