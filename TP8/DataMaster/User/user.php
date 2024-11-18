<?php
    $page = "Data Master";
    $title = "Data User";
    include "../../Components/header.php";
    include "../../fungsi.php";

    $user = getAllUser();
?>


<div class="container">
    <h2 class="text-secondary my-4">Daftar User</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="tambahUser.php" class="btn btn-success">Tambah User</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Level</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $no => $row): ?>
                <tr>
                    <td><?= $no + 1 ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= ($row['level'] == 1) ? "Owner" : "Kasir"; ?></td>
                    <td>
                        <a href="<?= ROOT ?>/DataMaster/User/editUser.php?id=<?= $row['id_user'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= ROOT ?>/DataMaster/User/deleteUser.php?id=<?= $row['id_user'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../../Components/footer.php" ?>