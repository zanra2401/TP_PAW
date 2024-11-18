<?php
    $page = "Data Master";
    $title = "tambah User";    
    include "../../Components/header.php";
    include "../../fungsi.php";
    
    if (isset($_POST['edit'])) {
      tambahUser();
    }

?>

<style>

    .form-container {
        width: 500px;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #333;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="password"],
    textarea,
    select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
        height: 60px;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .btn-save {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-cancel {
        background-color: #f44336;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-save:hover {
        background-color: #45a049;
    }

    .btn-cancel:hover {
        background-color: #e53935;
    }

</style>

<div class="form-container mx-auto my-5">
    <h2>Tambah User Baru</h2>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username"  required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <label for="nama">Nama User</label>
        <input type="text" id="nama" name="nama" placeholder="Nama User" required>

        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" placeholder="Alamat" required></textarea>

        <label for="nomorhp">Nomor HP</label>
        <input type="text" name="telp" id="nomorhp" placeholder="Nomor HP" required>

        <label for="jenisuser">Jenis User</label>
        <select id="jenisuser" name="level" required>
            <option value=1>Admin</option>
            <option value=2>User Biasa</option>
        </select>

        <div class="button-group">
            <button type="submit" name="edit" class="btn-save">Simpan</button>
            <a href="<?= ROOT ?>/DataMaster/User/user.php" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

<?php include "../../Components/footer.php" ?>