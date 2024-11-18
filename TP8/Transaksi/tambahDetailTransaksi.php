<?php
    

    include "../Components/header.php";
    include "../fungsi.php";
    

    if (isset($_POST['submit'])) {
        $data = [];

        
        for ($i = 0; $i < count($_POST["barang"]); $i++)
        {
            if (strlen($_POST["quantity"][$i]) < 1)
            {
                echo "<script>alert('Tolong Masukan data dengan lengkap'); window.location.href = '" . ROOT . "/Transaksi/tambahDetailTransaksi.php'</script>";
            }

            $data[] = [$_POST["barang"][$i], $_POST["id_transaksi"][$i], $_POST["quantity"][$i]];
        }

        for ($i = 0; $i < count($data); $i++) 
        {
            for ($j = 0; $j < count($data); $j++) 
            {
                if ($j != $i) 
                {
                    if ($data[$i][0] == $data[$j][0] && $data[$j][1] == $data[$i][1])
                    {
                        {
                            echo "<script>alert('setiap item harus memili data barang atau id transaksi yang berbeda'); window.location.href = '" . ROOT . "/Transaksi/tambahDetailTransaksi.php'</script>";
                        }
                    }
                }
            }
        }

       foreach ($data as $value)
       {
            insertTransaksiDetail($value[0], $value[1], $value[2]);
       }
    }

    $query_barang = "SELECT * FROM barang";
    $query_transaksi = "SELECT * FROM transaksi";

    $barang = mysqli_query(DB, $query_barang);
    $transaksi = mysqli_query(DB, $query_transaksi);
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


<div class="container mx-auto my-5" style="width: fit-content;">
    <h3>Tambah Detail Transaksi</h3>
    <form id="form-detail-transaksi" action="" method="POST" style="width: fit-content;">

        <button onclick="tambahItem()" type="button" name="submit" style="margin-top: 20px"><i class="fas fa-plus"></i></button>
        <button type="submit" name="submit" style="margin-top: 20px">Tambah Detail Transaksi</button>

        <div class="d-flex my-3 align-items-center justify-content-between" style="width: 500px; gap: 5px;">
            <select style="margin-bottom: 0px; width: 30%;" name="barang[]" id="barang" placeholder="Pilih Barang">
                <?php foreach ($barang as $row): ?>
                    <option value=<?= $row['id'] ?>><?= $row["nama_barang"] ?></option>
                <?php endforeach; ?>
            </select>
            <select style="margin-bottom: 0px; width: 30%;" name="id_transaksi[]" id="id_transaksi" placeholder="pilih transaksi id">
                <?php foreach ($transaksi as $row): ?>
                    <option value=<?= $row['id'] ?>><?= $row['id'] ?></option>
                <?php endforeach; ?>
            </select>
            <input style="margin-bottom: 0px; width: 30%;" type="text" name="quantity[]" id="quantity" placeholder="Masukkan jumlah barang">
        </div>
    </form>

</div>

<script>
    const formDetailTransaksi = document.getElementById("form-detail-transaksi");
    function tambahItem() {
        let item = `<div class="d-flex my-3 align-items-center justify-content-between" style="width: 500px; gap: 5px;">
            <select style="margin-bottom: 0px; width: 30%;" name="barang[]" id="barang" placeholder="Pilih Barang">
                <?php foreach ($barang as $row): ?>
                    <option value=<?= $row['id'] ?>><?= $row["nama_barang"] ?></option>
                <?php endforeach; ?>
            </select>
            <select style="margin-bottom: 0px; width: 30%;" name="id_transaksi[]" id="id_transaksi" placeholder="pilih transaksi id">
                <?php foreach ($transaksi as $row): ?>
                    <option value=<?= $row['id'] ?>><?= $row['id'] ?></option>
                <?php endforeach; ?>
            </select>
            <input style="margin-bottom: 0px; width: 30%;" type="text" name="quantity[]" id="quantity" placeholder="Masukkan jumlah barang">
        </div>`;


        formDetailTransaksi.insertAdjacentHTML('beforeend', item);

    }
</script>

<?php include "../Components/footer.php" ?>