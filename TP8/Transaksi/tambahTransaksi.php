<?php
    include "../Components/header.php";
    include "../fungsi.php";
    

    if (isset($_POST["submit"])) {
        $waktu = $_POST["waktu_transaksi"];
        $keterangan = $_POST["keterangan"];
        $pelanggan = $_POST["pelanggan"];

        $query = "INSERT INTO transaksi(waktu_transaksi, keterangan, total, pelanggan_id) VALUES('$waktu', '$keterangan', 0, $pelanggan)";
        
        $errors = array_merge(validateWaktu($_POST, "waktu_transaksi"), validateKet($_POST, "keterangan"));
            
        if (count($errors) < 1) {
            mysqli_query(DB, $query);
            header("Location: transaksi.php");
        }
        
    }

    $query = "SELECT * FROM pelanggan";

    $pelanggan = mysqli_query(DB, $query);
?>

    <style>
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
        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        textarea {
            height: 60px;
            max-width: 100%;
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

        input, textarea {
            box-sizing: border-box;

        }
    </style>
</head>
<body>

<div class="container my-5">
    <h3>Tambah Data Transaksi</h3>
    <form action="" method="POST">
        <label for="waktu_transaksi">Waktu Transaksi</label>
        <input value="<?= (isset($_POST['waktu_transaksi'])) ? $_POST['waktu_transaksi'] : '' ?>" style="margin-bottom: 0px;" type="date" name="waktu_transaksi" id="waktu_transaksi" placeholder="dd/mm/yyyy" require>
        <p style="color: red; margin-top: 2px;"><?= (isset($_POST["submit"]) and count($errors) > 0) ? $errors["waktu_transaksi"] : ""; ?></p>
        
        <label for="keterangan">Keterangan</label>
        <textarea  style="margin-bottom: 0px;" name="keterangan" id="keterangan" placeholder="Masukkan keterangan transaksi"><?= (isset($_POST['keterangan'])) ? $_POST['keterangan'] : '' ?></textarea>
        <p style="color: red; margin-top: 2px;"><?= (isset($_POST["submit"]) and count($errors) > 0) ? $errors["keterangan"] : ""; ?></p>

        <label for="pelanggan">Pelanggan</label>
        <select name="pelanggan" id="pelanggan">
            <?php foreach ($pelanggan as $row): ?>
                <option value="<?= $row["id"] ?>"><?= $row["nama"] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="submit">Tambah Transaksi</button>
    </form>
</div>

<?php include "../Components/footer.php"; ?>

