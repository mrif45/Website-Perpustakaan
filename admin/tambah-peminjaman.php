<?php include('includes/config.php'); ?>
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

    <title>Perpustakaan | Manajemen Peminjaman</title>
</head>

<body id="body-pd">
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
                    <a href="dashboard.php" class="nav__link">
                        <i class='bx bxs-dashboard nav__icon'></i>
                        <span class="nav__name">Dashboard</span>
                    </a>

                    <a href="manajemen-kategori.php" class="nav__link">
                        <i class='bx bxs-folder nav__icon'></i>
                        <span class="nav__name">Kategori</span>
                    </a>

                    <a href="manajemen-buku.php" class="nav__link">
                        <i class='bx bxs-book-alt nav__icon'></i>
                        <span class="nav__name">Buku</span>
                    </a>

                    <a href="manajemen-peminjaman.php" class="nav__link active">
                        <i class='bx bxs-cart-add nav__icon'></i>
                        <span class="nav__name">Peminjaman</span>
                    </a>

                    <a href="anggota.php" class="nav__link">
                        <i class='bx bxs-user nav__icon'></i>
                        <span class="nav__name">Anggota</span>
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

    <div class=" content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Detail Peminjaman Buku</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
<div class=" panel panel-info">
                    <div class="panel-heading">
                        Detail Peminjaman Buku
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <?php
                            $rid = intval($_GET['rid']);
                            $sql = "SELECT siswa.nama_siswa, buku.nama_buku, buku.ISBN, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.id_peminjaman as rid, peminjaman.denda, peminjaman.status from  peminjaman join siswa on siswa.id_siswa=peminjaman.id_siswa join buku on buku.id_buku=peminjaman.id_buku where peminjaman.id_peminjaman=:rid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {?>
                                    <div class="form-group">
                                        <label>Nama Siswa :</label>
                                        <?php echo htmlentities($result->FullName); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Buku :</label>
                                        <?php echo htmlentities($result->BookName); ?>
                                    </div>


                                    <div class="form-group">
                                        <label>ISBN :</label>
                                        <?php echo htmlentities($result->ISBNNumber); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Peminjaman :</label>
                                        <?php echo htmlentities($result->IssuesDate); ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Kembali :</label>
                                        <?php if ($result->ReturnDate == "") {
                                            echo htmlentities("Not Return Yet");
                                        } else {
                                            echo htmlentities($result->ReturnDate);
                                        }
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <label> Denda :</label>
                                        <?php
                                        if ($result->fine == "") { ?>
                                            <input class="form-control" type="text" name="fine" id="fine" required />
                                        <?php } else {
                                            echo htmlentities($result->fine);
                                        }
                                        ?>
                                    </div>
                                    <?php if ($result->RetrunStatus == 0) { ?>

                                        <button type="submit" name="return" id="submit" class="btn btn-info">Pengembalian Buku </button>
                                    </div>
                                <?php }
                                }
                            } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include('includes/script.php'); ?>
</body>

</html>