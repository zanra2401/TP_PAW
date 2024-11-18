<?php
    $page = "Data Master";
    $title = "Data Barang";
    include "Components/header.php";
    include "fungsi.php";
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
  <h1>Data Barang</h1>
  <a href="tambahBarang.php" class="btn-add">Tambah Data</a>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Supplier</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $barangs = getBarang(DB); // Mengambil data barang

      $no = 1;
      foreach ($barangs as $barang) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$barang['kode_barang']}</td>
                <td>{$barang['nama_barang']}</td>
                <td>Rp " . number_format($barang['harga'], 0, ',', '.') . "</td>
                <td>{$barang['stok']}</td>
                <td>{$barang['supplier_id']}</td>
                <td>
                  <a href='editBarang.php?id={$barang['id']}' class='btn-edit'>Edit</a>
                  <a href='deleteBarang.php?deleteid={$barang['id']}' onclick='deleteConfirm(event)' class='btn-delete'>Hapus</a>
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
    let confirmation = confirm("Yakin Anda ingin menghapus data Barang?");
    if (!confirmation) {
      event.preventDefault();
    }
  }
</script>

<?php include "Components/footer.php"; ?>
