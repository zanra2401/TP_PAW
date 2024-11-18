<?php

function login($data, $errors) 
{
    $username = $data["username"];
    $password = $data["password"];
  
    $result = mysqli_query(DB, "SELECT * FROM user WHERE username = '$username' AND password = SHA2('$password', 256)");

    if (mysqli_num_rows($result) > 0) {  
      $user = mysqli_fetch_assoc($result);
      $_SESSION["user"] = $user["nama"];
      $_SESSION["role"] = ($user["level"] == 1) ? "Owner" : "Kasir";
      header("Location: index.php");
    } else {
      $errors[] = "Username atau password salah";
      return $errors;
    }
}

function getAllUser()
{
    $query = "SELECT * FROM user";
    return mysqli_query(DB, $query);
}

function tambahUser()
{
    $username = $_POST['username'];
    $password = $_POST["password"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $nohp = $_POST['telp'];
    $level = $_POST["level"];

    $query = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES ('$username', SHA2('$password', 256), '$nama', '$alamat', '$nohp', '$level')";

    if (mysqli_query(DB, $query)) {
        header("Location: user.php");
    }
}

function updateUser($id)
{
    $username = $_POST['username'];
    $password = $_POST["password"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $nohp = $_POST['telp'];
    $level = $_POST["level"];


    if (strlen($password) > 0) {
        $query = "UPDATE user SET username = '$username', password = SHA2('$password', 256), nama = '$nama', alamat = '$alamat', hp = '$nohp', level = $level WHERE id_user = $id";
    } else {
        $query = "UPDATE user SET username = '$username', nama = '$nama', alamat = '$alamat', hp = '$nohp', level = $level WHERE id_user = $id";
    }


    if (mysqli_query(DB, $query)) {
        header("Location: user.php");
    }
}

function deleteUser($id) 
{
    $query = "DELETE FROM user WHERE id_user = $id";
    return mysqli_query(DB, $query);
}



function getSuppliers($DB)
{
  $query = "SELECT * FROM supplier";
  $result = mysqli_query($DB, $query);

  return $result;
}


function getPelanggan($DB)
{
  $query = "SELECT * FROM pelanggan";
  $result = mysqli_query($DB, $query);

  return $result;
}


function getBarang($DB)
{
  $query = "SELECT * FROM barang";
  $result = mysqli_query($DB, $query);

  return $result;
}

function insertDataSupplier($nama, $telp, $alamat, $DB)
{
  $query = "INSERT INTO supplier(nama, telp, alamat) VALUES('$nama', '$telp', '$alamat')";
  mysqli_query($DB, $query);
}

function deleteDataSupplier($DB, $id)
{
  $query = "DELETE FROM supplier WHERE id = $id";
  mysqli_query($DB, $query);
}

function updateDataSupplier($DB, $id, $nama, $telp, $alamat)
{
  $query = "UPDATE supplier SET nama = '$nama', telp = '$telp', alamat = '$alamat' WHERE id = $id";
  mysqli_query($DB, $query);
}

function validateName($method, $name)
{
  if (trim($method[$name]) == "") {
    return [$name => "$name tidak boleh kosong"];
  }

  $reg = "/^[a-zA-Z., ]+$/";
  if (!preg_match($reg, $method[$name])) {
    return [$name => "$name tidak boleh mengandung selain huruf"];
  }

  return [];
}

function validateTelp($method, $name)
{
  if (trim($method[$name]) == "") {
    return [$name => "$name tidak boleh kosong"];
  }

  $reg = "/^[0-9]+$/";
  if (!preg_match($reg, $method[$name])) {
    return [$name => "$name tidak boleh mengandung selain angka"];
  }

  return [];
}

function validateJenisKelamin($method, $name)
{
    if (!in_array($method[$name], ['L', 'P'])) {
        return [$name => "$name harus diisi dengan 'L' atau 'P'"];
    }

    return [];
}


function validateAlamat($method, $name)
{
  if (trim($method[$name]) == "") {
    return [$name => "$name tidak boleh kosong"];
  }

  $reg = "/^[a-zA-Z0-9.,\/ ]+$/";
  if (!preg_match($reg, $method[$name])) {
    return [$name => "$name tidak boleh mengandung selain alfanumerik"];
  }

  if (!preg_match("/[0-9]/", $method[$name])) {
    return [$name => "$name setidaknya mengandung satu huruf dan satu angka"];
  }

  if (!preg_match("/[a-zA-Z]/", $method[$name])) {
    return [$name => "$name setidaknya mengandung satu huruf dan satu angka"];
  }

  return [];
}

function validateKodeBarang($data, $field)
{
    $errors = [];
    if (empty($data[$field])) {
        $errors[$field] = "Kode barang tidak boleh kosong.";
    }
    return $errors;
}

function validateNamaBarang($data, $field)
{
    $errors = [];
    if (empty($data[$field])) {
        $errors[$field] = "Nama barang tidak boleh kosong.";
    }
    return $errors;
}

function validateHarga($data, $field)
{
    $errors = [];
    if (empty($data[$field])) {
        $errors[$field] = "Harga tidak boleh kosong.";
    } elseif (!is_numeric($data[$field]) || $data[$field] <= 0) {
        $errors[$field] = "Harga harus berupa angka positif.";
    }
    return $errors;
}

function validateStok($data, $field)
{
    $errors = [];
    if (empty($data[$field])) {
        $errors[$field] = "Stok tidak boleh kosong.";
    } elseif (!is_numeric($data[$field]) || $data[$field] < 0) {
        $errors[$field] = "Stok harus berupa angka dan minimal 0.";
    }
    return $errors;
}

function validateSupplierId($data, $field)
{
    $errors = [];
    if (empty($data[$field])) {
        $errors[$field] = "Supplier ID tidak boleh kosong.";
    } elseif (!is_numeric($data[$field])) {
        $errors[$field] = "Supplier ID harus berupa angka.";
    }
    return $errors;
}


function getDataSupplier($DB, $field, $id)
{
  $query = "SELECT $field FROM supplier WHERE id = $id";
  return mysqli_fetch_assoc(mysqli_query($DB, $query))[$field];
}

function tambahSupplier()
{
  $errors_nama = validateName($_POST, "nama");
  $errors_telp = validateTelp($_POST, "telp");
  $errors_alamat = validateAlamat($_POST, "alamat");
  $errors = array_merge($errors_nama, $errors_telp, $errors_alamat);
  if (count($errors) > 0) {
    return $errors;
  }
  
  if (count($errors) < 1) {
    insertDataSupplier(trim($_POST["nama"]), trim($_POST["telp"]), trim($_POST["alamat"]), DB);
    header("Location: supplier.php");
  }

}


function deleteSupplier() {
  deleteDataSupplier(DB, $_GET["deleteid"]);
  header("Location: supplier.php");
}

function updateSupplier() {
  $errors_nama = validateName($_POST, "nama");
  $errors_telp = validateTelp($_POST, "telp");
  $errors_alamat = validateAlamat($_POST, "alamat");
  $errors = array_merge($errors_nama, $errors_telp, $errors_alamat);
  if (count($errors) > 0) {
    return $errors;
  }

  if (count($errors) < 1) {
    updateDataSupplier(DB, $_POST['id'], trim($_POST["nama"]), trim($_POST["telp"]), trim($_POST["alamat"]));
  }
  header("Location: supplier.php");
}


function insertDataPelanggan($nama, $jenis_kelamin, $telp, $alamat, $DB)
{
    $query = "INSERT INTO pelanggan (nama, jenis_kelamin, telp, alamat) VALUES ('$nama', '$jenis_kelamin', '$telp', '$alamat')";
    mysqli_query($DB, $query);
}

function deleteDataPelanggan($DB, $id)
{
    $query = "DELETE FROM pelanggan WHERE id = $id";
    mysqli_query($DB, $query);
}

function updateDataPelanggan($DB, $id, $nama, $jenis_kelamin, $telp, $alamat)
{
    $query = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat' WHERE id = $id";
    mysqli_query($DB, $query);
}

function getDataPelanggan($DB, $field, $id)
{
    $query = "SELECT $field FROM pelanggan WHERE id = $id";
    $result = mysqli_query($DB, $query);
    return mysqli_fetch_assoc($result)[$field];
}

function tambahDataPelanggan()
{
    $errors_nama = validateName($_POST, "nama");
    $errors_kelamin = validateJenisKelamin($_POST, "jenis_kelamin");
    $errors_telp = validateTelp($_POST, "telp");
    $errors_alamat = validateAlamat($_POST, "alamat");
    $errors = array_merge($errors_nama, $errors_kelamin, $errors_telp, $errors_alamat);

    if (count($errors) > 0) {
        return $errors;
    }

    insertDataPelanggan(trim($_POST["nama"]), trim($_POST["jenis_kelamin"]), trim($_POST["telp"]), trim($_POST["alamat"]), DB);
    header("Location: pelanggan.php");
}

function deletePelanggan()
{

    deleteDataPelanggan(DB, $_GET["deleteid"]);
    header("Location: pelanggan.php");
}

function updatePelanggan()
{

    $errors_nama = validateName($_POST, "nama");
    $errors_kelamin = validateJenisKelamin($_POST, "jenis_kelamin");
    $errors_telp = validateTelp($_POST, "telp");
    $errors_alamat = validateAlamat($_POST, "alamat");
    $errors = array_merge($errors_nama, $errors_kelamin, $errors_telp, $errors_alamat);

    if (count($errors) > 0) {
        return $errors;
    }

    updateDataPelanggan(DB, $_POST["id"], trim($_POST["nama"]), trim($_POST["jenis_kelamin"]), trim($_POST["telp"]), trim($_POST["alamat"]));
    header("Location: pelanggan.php");
}


function insertDataBarang($kode_barang, $nama_barang, $harga, $stok, $supplier_id, $DB)
{
    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES ('$kode_barang', '$nama_barang', $harga, $stok, $supplier_id)";
    mysqli_query($DB, $query);
}

function deleteDataBarang($DB, $id)
{
    $query = "DELETE FROM barang WHERE id = $id";
    mysqli_query($DB, $query);
}

function updateDataBarang($DB, $id, $kode_barang, $nama_barang, $harga, $stok, $supplier_id)
{
    $query = "UPDATE barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', harga = $harga, stok = $stok, supplier_id = $supplier_id WHERE id = $id";
    mysqli_query($DB, $query);
}

function getDataBarang($DB, $field, $id)
{
    $query = "SELECT $field FROM barang WHERE id = $id";
    $result = mysqli_query($DB, $query);
    return mysqli_fetch_assoc($result)[$field];
}

function tambahDataBarang()
{
    $errors_kode_barang = validateKodeBarang($_POST, "kode_barang");
    $errors_nama_barang = validateNamaBarang($_POST, "nama_barang");
    $errors_harga = validateHarga($_POST, "harga");
    $errors_stok = validateStok($_POST, "stok");
    $errors_supplier = validateSupplierId($_POST, "supplier_id");

    $errors = array_merge($errors_kode_barang, $errors_nama_barang, $errors_harga, $errors_stok, $errors_supplier);

    if (count($errors) > 0) {
        return $errors;
    }

    insertDataBarang(trim($_POST["kode_barang"]), trim($_POST["nama_barang"]), $_POST["harga"], $_POST["stok"], $_POST["supplier_id"], DB);
    header("Location: barang.php");
}

function deleteBarang()
{
    deleteDataBarang(DB, $_GET["deleteid"]);
    header("Location: barang.php");
}

function updateBarang()
{
    $errors_kode_barang = validateKodeBarang($_POST, "kode_barang");
    $errors_nama_barang = validateNamaBarang($_POST, "nama_barang");
    $errors_harga = validateHarga($_POST, "harga");
    $errors_stok = validateStok($_POST, "stok");
    $errors_supplier = validateSupplierId($_POST, "supplier_id");

    $errors = array_merge($errors_kode_barang, $errors_nama_barang, $errors_harga, $errors_stok, $errors_supplier);

    if (count($errors) > 0) {
        return $errors;
    }

    updateDataBarang(DB, $_POST["id"], trim($_POST["kode_barang"]), trim($_POST["nama_barang"]), $_POST["harga"], $_POST["stok"], $_POST["supplier_id"]);
    header("Location: barang.php");
}


function deleteTransaksi()
{
    $query = "DELETE FROM transaksi WHERE id = {$_GET['deleteid']}";
    mysqli_query(DB, $query);
}

function validatetBarang($method, $name, $conn, $id_transaksi) {
    $barang_id = $method[$name];
    $id_transaksi = $id_transaksi;

    $query = "SELECT * FROM transaksi_detail WHERE barang_id = $barang_id AND transaksi_id = $id_transaksi";

    if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
        return [$name => "$name sudah ada pada detail transaksi"];
    }

    return [];
}


function insertTransaksiDetail($barang, $id_transaksi, $qty)
{
    $harga = (int)mysqli_fetch_assoc(mysqli_query(DB, "SELECT harga FROM barang WHERE id = $barang"))['harga'];

    $hargaBarang = (int)mysqli_fetch_assoc(mysqli_query(DB, "SELECT harga FROM barang WHERE id = $barang"))['harga'] * (int)$qty;

    $query_update_transaksi = "UPDATE transaksi SET total = total + $hargaBarang WHERE id = $id_transaksi";

    $query = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES($id_transaksi, $barang, $harga, $qty)";
   
    mysqli_query(DB, $query);
    mysqli_query(DB, $query_update_transaksi);
    header("Location: transaksi.php");

}

function validateWaktu($method, $name) {

  if (empty($method[$name])) {
      return [$name => "$name tidak boleh kosong"];
  }

  $today = new DateTime('now');
  $today->setTime(0, 0, 0);
  $waktu_transaksi = new DateTime($method[$name]);

  if ($waktu_transaksi < $today) {
      return [$name => "$name tidak boleh sebelum hari ini"];
  }

  return [];
}

function validateKet($method, $name) {
  $ket = $method[$name];
  if (strlen($ket) < 3) {
      return [$name => "$name minimal 3 character"];
  }

  return [];
}