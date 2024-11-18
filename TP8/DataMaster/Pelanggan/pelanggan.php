<?php
    $page = "Data Master";
    $title = "Data Pelanggan";
    include "../../Components/header.php";
    include "../../fungsi.php";
?>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
  }

  h1 {
    text-align: center;
    margin-bottom: 20px;
  }

  .btn-add {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
    transition: background-color 0.3s ease;
  }

  .btn-add:hover {
    background-color: #0056b3;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  table,
  th,
  td {
    border: 1px solid #ddd;
  }

  th,
  td {
    padding: 12px;
    text-align: left;
  }

  th {
    background-color: #e9f5ff;
  }

  td {
    background-color: #f9f9f9;
  }

  .btn-edit,
  .btn-delete {
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
    color: white;
  }

  .btn-edit {
    background-color: #17a2b8;
  }

  .btn-edit:hover {
    background-color: #138496;
  }

  .btn-delete {
    background-color: #dc3545;
  }

  .btn-delete:hover {
    background-color: #c82333;
  }
</style>


<div class="container">
  <h1>Data Pelanggan</h1>
  <a href="tambahPelanggan.php" class="btn-add">Tambah Data</a>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $pelanggans = getPelanggan(DB); 

      $no = 1;
      foreach ($pelanggans as $pelanggan) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$pelanggan['nama']}</td>
                <td>{$pelanggan['jenis_kelamin']}</td>
                <td>{$pelanggan['telp']}</td>
                <td>{$pelanggan['alamat']}</td>
                <td>
                  <a href='" . ROOT . "/DataMaster/Pelanggan/editPelanggan.php?id={$pelanggan['id']}' class='btn-edit'>Edit</a>
                  <a href='" . ROOT . "/DataMaster/Pelanggan/deletePelanggan.php?deleteid={$pelanggan['id']}' onclick='deleteConfirm(event)' class='btn-delete'>Hapus</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<script>
  function deleteConfirm(event) {
    let confirmation = confirm("Yakin Anda ingin menghapus data Pelanggan?");
    if (!confirmation) {
      event.preventDefault();
    }
  }
</script>


<?php include "../../Components/footer.php" ?>