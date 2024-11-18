<?php
    require "conn.php";

    function validatetBarang($method, $name, $conn, $id_transaksi) {
        $barang_id = $method[$name];
        $id_transaksi = $id_transaksi;

        $query = "SELECT * FROM transaksi_detail WHERE barang_id = $barang_id AND transaksi_id = $id_transaksi";

        if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
            return [$name => "$name sudah ada pada detail transaksi"];
        }

        return [];
    }

    if (isset($_POST['submit'])) {
        $barang = $_POST['barang'];
        $id_transaksi = $_POST['id_transaksi'];
        $qty = $_POST["quantity"];

        $harga = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang"))['harga'];

        $hargaBarang = (int)mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang"))['harga'] * (int)$qty;

        $query_update_transaksi = "UPDATE transaksi SET total = total + $hargaBarang WHERE id = $id_transaksi";

        $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty, subtotal) VALUES($id_transaksi, $barang, $harga, $qty, $hargaBarang)";
        $errors = validatetBarang($_POST, "barang", $conn, $id_transaksi);
        if (count($errors) < 1) {
            mysqli_query($conn, $query);
            mysqli_query($conn, $query_update_transaksi);
            header("Location: index.php");
        }
    }

    $query_barang = "SELECT * FROM barang";
    $query_transaksi = "SELECT * FROM transaksi";

    $barang = mysqli_query($conn, $query_barang);
    $transaksi = mysqli_query($conn, $query_transaksi);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        .container {
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        h3 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }

        input {
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Tambah Detail Transaksi</h3>
    <form action="" method="POST">
        <label for="barang">Pilih Barang</label>
        <select style="margin-bottom: 0px;" name="barang" id="barang">
            <?php foreach ($barang as $row): ?>
                <option value=<?= $row['id'] ?>><?= $row["nama_barang"] ?></option>
            <?php endforeach; ?>
        </select>
        <p style="color: red; margin-top: 2px;"><?= (isset($_POST["submit"]) and count($errors) > 0) ? $errors["barang"] : ""; ?></p>


        <label for="id_transaksi">ID Transaksi</label>
        <select name="id_transaksi" id="id_transaksi">
            <?php foreach ($transaksi as $row): ?>
                <option value=<?= $row['id'] ?>><?= $row['id'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input value="<?= (isset($_POST["quantity"])) ? $_POST['quantity'] : '' ?>" type="text" name="quantity" id="quantity" placeholder="Masukkan jumlah barang">

        <button type="submit" name="submit">Tambah Detail Transaksi</button>
    </form>
</div>

</body>
</html>
