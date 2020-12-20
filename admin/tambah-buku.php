<?php include('includes/config.php');
if (isset($_POST['add'])) {
    $nama_buku = $_POST['nama_buku'];
    $kategori = $_POST['kategori'];
    $isbn = $_POST['isbn'];
    $harga = $_POST['harga'];
    $sql = "INSERT INTO buku(nama_buku,id_kategori,ISBN,harga) VALUES (:nama_buku, :kategori, :isbn,:harga)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':nama_buku', $nama_buku, PDO::PARAM_STR);
    $query->bindParam(':kategori', $kategori, PDO::PARAM_STR);
    $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $query->bindParam(':harga', $harga, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['msg'] = "DATA BUKU TELAH BERHASIL DIINPUTKAN";
        header('location:manajemen-buku.php');
    } else {
        $_SESSION['error'] = "GAGAL MENGINPUTKAN, COBA LAGI";
        header('location:manajemen-buku.php');
    }
} ?>
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

    <title>Perpustakaan | Tambah Buku</title>
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
                    <h4 class="header-line">Tambah Buku</h4>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
                <div class=" panel panel-info">
                    <div class="panel-heading">
                        Info Buku
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Nama Buku <span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="nama_buku" autocomplete="off" required />
                            </div>

                            <div class="form-group">
                                <label> Kategori<span style="color:red;">*</span></label>
                                <select class="form-control" name="kategori" required="required">
                                    <option value=""> Pilih Kategori</option>
                                    <?php
                                    $status = 1;
                                    $sql = "SELECT * from kategori where status =:status";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {?>
                                            <option value="<?php echo htmlentities($result->id_kategori); ?>"><?php echo htmlentities($result->nama_kategori); ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nomor ISBN<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="isbn" required="required" autocomplete="off" />
                                <p class="help-block"></p>*Nomor ISBN Harus Unik</p>
                            </div>

                            <div class="form-group">
                                <label>Harga<span style="color:red;">*</span></label>
                                <input class="form-control" type="text" name="harga" autocomplete="off" required="required" />
                            </div>
                            <button type="submit" name="add" class="btn btn-info">Tambah</button>
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