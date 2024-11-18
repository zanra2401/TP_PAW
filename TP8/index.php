<?php
    $page = "home";
    $title = "HOMEPAGE";
    include "Components/header.php";

    $query = "SELECT * FROM transaksi";
    $totalTransaksi = mysqli_num_rows(mysqli_query(DB, $query));
?>


<style>
    .card-box {
   position: relative;
   color: #fff;
   padding: 10px 20px;
   margin: 20px 0;
   border-radius: 5px;
   display: flex;
   justify-content: space-between; /* Membuat teks dan ikon berada pada sisi yang berlawanan */
   align-items: center; /* Vertikal align ikon dan teks */
}
.card-box:hover {
   text-decoration: none;
   color: #f1f1f1;
}
.card-box:hover .icon i {
   font-size: 80px;
   transition: 0.5s;
   /* -webkit-transition: 1s; */
}
.card-box .inner {
   display: flex;
   flex-direction: column;
   justify-content: space-between;
   align-items: flex-start; /* Letakkan teks di sisi kiri */
}
.card-box h3 {
   font-size: 27px;
   font-weight: bold;
   margin: 0;
   white-space: nowrap;
   text-align: left;
}
.card-box p {
   font-size: 15px;
   margin: 0;
}
.card-box .icon {
   font-size: 72px;
   color: rgba(0, 0, 0, 0.15);
   margin-left: auto; /* Dorong ikon ke kanan */
}

.bg-blue {
   background-color: #00c0ef !important;
}
</style>


<div class="container my-4">
    <h2>Sistem Penjualan</h2>
    <div class="row">
        <div class="col-lg-3 col-sm-6" onclick="pindahKeTransaksi()">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3 style="text-decoration: none;"><?= $totalTransaksi ?></h3>
                    <p style="text-decoration: none;">Transaksi</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function pindahKeTransaksi()
    {
        window.location.href = "/Transaksi/transaksi.php";
    }
</script>

<?php include "Components/footer.php"; ?>