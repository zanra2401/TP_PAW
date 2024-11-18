<?php
    $page = "Data Master";
    $title = "edit Barang";
    include "../../Components/header.php";
    include "../../fungsi.php";

    $errors = [];
    if (isset($_POST["edit"])) {
        $errors = updateBarang();
    }

    $suppliers = getSuppliers(DB);
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

  input[type="text"], input[type="number"], select {
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
    <h1>Edit Data Barang</h1>
    <form action="" method="POST">
      <div class="form-group">
        <label for="kode_barang">Kode Barang</label>
        <input type="text" id="kode_barang" name="kode_barang" value="<?= isset($_POST["kode_barang"]) ? $_POST["kode_barang"] : getDataBarang(DB, 'kode_barang', $_GET['id']) ?>">
        <p style="color: red;"><?php echo (isset($errors["kode_barang"])) ? $errors["kode_barang"] : ""  ?></p>
      </div>
      <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" id="nama_barang" name="nama_barang" value="<?= isset($_POST["nama_barang"]) ? $_POST["nama_barang"] : getDataBarang(DB, 'nama_barang', $_GET['id']); ?>">
        <p style="color: red;"><?php echo (isset($errors["nama_barang"])) ? $errors["nama_barang"] : "" ?></p>
      </div>
      <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" value="<?= isset($_POST['harga']) ? $_POST['harga'] : getDataBarang(DB, 'harga', $_GET['id']) ?>">
        <p style="color: red;"><?php echo (isset($errors["harga"])) ? $errors["harga"] : ""  ?></p>
      </div>
      <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" id="stok" name="stok" value="<?= isset($_POST['stok']) ? $_POST['stok'] : getDataBarang(DB, 'stok', $_GET['id']) ?>">
        <p style="color: red;"><?php echo (isset($errors["stok"])) ? $errors["stok"] : ""  ?></p>
      </div>
      <div class="form-group">
        <label for="supplier_id">Supplier ID</label>
        <select name="supplier_id" id="supplier" required>
                <option value="">-- Pilih Supplier --</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['id'] ?>" <?= (getDataBarang(DB, 'supplier_id', $_GET['id']) == $supplier['id']) ? 'selected' : '' ?>><?= $supplier['nama'] ?></option>
                <?php endforeach; ?>
        </select>
        <p style="color: red;"><?php echo (isset($errors["supplier_id"])) ? $errors["supplier_id"] : ""  ?></p>
      </div>
      <input type="number" name="id" value=<?= $_GET["id"] ?> hidden>
      <div class="form-actions">
        <button type="submit" name="edit" class="btn-submit">Edit</button>
        <a href="<?= ROOT ?>/DataMaster/Barang/barang.php" class="btn-cancel">Batal</a>
      </div>
    </form>
  </div>

<?php include "../../Components/footer.php" ?>
