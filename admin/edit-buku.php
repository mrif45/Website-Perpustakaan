<?php
session_start();
error_reporting(0);
include('includes/config.php'); ?>
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

    <title>Perpustakaan</title>
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

                    <a href="manajemen-buku.php" class="nav__link active">
                        <i class='bx bxs-book-alt nav__icon'></i>
                        <span class="nav__name">Buku</span>
                    </a>

                    <a href="manajemen-peminjaman.php" class="nav__link">
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
                    <h4 class="header-line">Edit Buku</h4>

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class=" panel panel-info">
                    <div class="panel-heading">
                        Info Buku
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <?php
                            $idbuku = intval($_GET['idbuku']);
                            $sql = "SELECT buku.nama_buku,kategori.nama_kategori,kategori.id_buku as id_kat,buku.ISBN, buku.harga,buku.id_buku as idbuku from buku join kategori on kategori.id_kategori=buku.id_kategori"; 
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':idbuku', $idbuku, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                    <div class="form-group">
                                        <label>Nama Buku<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="nama_buku" value="<?php echo htmlentities($result->nama_buku); ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label> Kategori<span style="color:red;">*</span></label>
                                        <select class="form-control" name="kategori" required="required">
                                            <option value="<?php echo htmlentities($result->id_kat); ?>"> <?php echo htmlentities($catname = $result->kategoriName); ?></option>
                                            <?php
                                            $status = 1;
                                            $sql1 = "SELECT * from  kategori where Status=:status"; //cek cek
                                            $query1 = $dbh->prepare($sql1);
                                            $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                            $query1->execute();
                                            $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                            if ($query1->rowCount() > 0) {
                                                foreach ($resultss as $row) {
                                                    if ($catname == $row->kategoriName) {
                                                        continue;
                                                    } else {
                                            ?>
                                                        <option value="<?php echo htmlentities($row->id_kategori); ?>"><?php echo htmlentities($row->kategoriName); ?></option>
                                            <?php }
                                                }
                                            } ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Nomor ISBN <span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNNumber); ?>" required="required" />
                                        <p class="help-block">Nomor ISBN Harus Unik</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Harga(Rp)</label><span style="color:red;">*</span></label>
                                        <!---ganti rp--->
                                        <input class="form-control" type="text" name="harga" value="<?php echo htmlentities($result->Bookharga); ?>" required="required" />
                                    </div>
                            <?php }
                            } ?>
                            <button type="submit" name="update" class="btn btn-info">Update </button>

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