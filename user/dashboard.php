<?php include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: ../index.php');
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- BOX ICONS -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />

        <!-- CSS -->
        <link rel="stylesheet" href="assets/css/styles.css">

        <title>Perpustakaan | User Dashboard</title>
    </head>

    <body id="body-pd">
        <!-- header & navbar -->
        <header class="header" id="header">
            <div class="header__toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="assets/Img/profile.png" alt="">
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="dashboard.php" class="nav__logo">
                        <i class='bx bxs-book-reader nav__logo-icon'></i>
                        <span class="nav__logo-name">Perpustakaan</span>
                    </a>

                    <div class="nav__list">
                        <a href="dashboard.php" class="nav__link active">
                            <i class='bx bxs-dashboard nav__icon'></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="peminjaman.php" class="nav__link">
                            <i class='bx bxs-cart-add nav__icon'></i>
                            <span class="nav__name">Peminjaman</span>
                        </a>

                        <a href="profil.php" class="nav__link">
                            <i class='bx bxs-user nav__icon'></i>
                            <span class="nav__name">Profil</span>
                        </a>

                        <a href="ganti-pass.php" class="nav__link">
                            <i class='bx bxs-key nav__icon'></i>
                            <span class="nav__name">Ganti Password</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!-- konten -->
        <div class="content-wrapper">
            <div class="container">
                <!-- judul -->
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">DASHBOARD</h4>
                    </div>
                </div>

                <div class="row">
                    <!-- buku yang dipinjam -->
                    <div class="col-md-5 col-sm-3 col-xs-6">
                        <div class="alert alert-info back-widget-set text-center">
                            <i class='bx bxs-book nav__icon'></i>
                            <?php
                            $sid = $_SESSION['stdid'];
                            $sql1 = "SELECT id_siswa from peminjaman where id_siswa=:sid";
                            $query1 = $dbh->prepare($sql1);
                            $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query1->execute();
                            $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                            $peminjaman = $query1->rowCount();
                            ?>

                            <h4><?php echo htmlentities($peminjaman); ?> </h4>
                            <h5>Buku yang dipinjam</h5>
                        </div>
                    </div>

                    <!-- buku yang belum dikembalikan -->
                    <div class="col-md-5 col-sm-3 col-xs-6">
                        <div class="alert alert-warning back-widget-set text-center">
                            <i class='bx bx-recycle nav__icon'></i>
                            <?php
                            $rsts = 1;
                            $sql2 = "SELECT id_pinjam from peminjaman where id_siswa=:sid and status=:rsts";
                            $query2 = $dbh->prepare($sql2);
                            $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
                            $query2->execute();
                            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                            $bukuKembali = $query2->rowCount();
                            ?>

                            <h4><?php echo htmlentities($bukuKembali); ?></h4>
                            <h5>Buku yang belum dikembalikan</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--===== MAIN JS =====-->
        <?php include('includes/script.php'); ?>
    </body>

    </html>
<?php } ?>