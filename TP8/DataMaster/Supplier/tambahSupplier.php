<?php
    $page = "Data Master";
    $title = "tambah Supplier";
    include "../../Components/header.php";
    include "../../fungsi.php";

    $errors = [];
    if (isset($_POST["tambah"])) {
        $errors = tambahSupplier();
    }
?>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 50%;
      margin: 50px auto;
      padding: 20px;
      border-radius: 8px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      width: 100%;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-size: 16px;
      margin-bottom: 5px;
      color: #333;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-actions {
      text-align: center;
      margin-top: 20px;
    }

    .btn-submit,
    .btn-cancel {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-submit {
      background-color: #007bff;
      color: white;
    }

    .btn-submit:hover {
      background-color: #218838;
    }

    .btn-cancel {
      background-color: #007bff;
      color: white;
      text-decoration: none;
    }

    .btn-cancel:hover {
      background-color: #c82333;
    }
  </style>
<div class="container">
  <h1>Tambah Data Supplier</h1>
  <form action="" method="POST">
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= isset($_POST["nama"]) ? $_POST["nama"] : "" ?>">
      <p style="color: red;"><?php echo (isset($errors["nama"])) ? $errors["nama"] : ""  ?></p>
    </div>
    <div class="form-group">
      <label for="telp">Telp</label>
      <input type="text" id="telp" name="telp" value="<?= isset($_POST["telp"]) ? $_POST["telp"] : ""; ?>">
      <p style="color: red;"><?php echo (isset($errors["telp"])) ? $errors["telp"] : ""  ?></p>
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" id="alamat" name="alamat" value="<?= isset($_POST["alamat"]) ? $_POST["alamat"] : ""; ?>">
      <p style="color: red;"><?php echo (isset($errors["alamat"])) ? $errors["alamat"] : ""  ?></p>
    </div>
    <div class="form-actions">
      <button type="submit" name="tambah" class="btn-submit">Tambah</button>
      <a href="<?= ROOT ?>/DataMaster/Supplier/supplier.php" class="btn-cancel">Batal</a>
    </div>
  </form>
</div>

<?php include "../../Components/footer.php" ?>