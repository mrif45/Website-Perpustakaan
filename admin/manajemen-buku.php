<?php include('includes/config.php');
if (isset($_GET['del'])) {
    $idbuku = $_GET['del'];
    $sql = "DELETE from buku WHERE id_buku=:id_buku";
    $query = $dbh->prepare($sql);
    $query->bindParam(':idbuku', $idbuku, PDO::PARAM_STR);
    $query->execute();
    $_SESSION['delmsg'] = "Kategori telah terhapus";
    header('location:manajemen-buku.php');
}?>
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

    <title>Perpustakaan | Manajemen Buku</title>
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

    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Manajemen Buku</h4>
                </div>
                <div class="row">
                    <?php if ($_SESSION['error'] != "") { ?>
                        <div class="col-md-6">
                            <div class="alert alert-danger">
                                <strong>Error :</strong>
                                <?php echo htmlentities($_SESSION['error']); ?>
                                <?php echo htmlentities($_SESSION['error'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") { ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['updatemsg'] != "") { ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['delmsg'] != "") { ?>
                        <div class="col-md-6">
                            <div class="alert alert-success">
                                <strong>Success :</strong>
                                <?php echo htmlentities($_SESSION['delmsg']); ?>
                                <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Buku
                            <div class="nav__icon__add">
                                <a href="edit-buku.php?id_buku=<?php echo htmlentities($result->id_buku); ?>">
                                    <button class="btn btn-success">
                                        <i class='bx bxs-pencil'></i> Tambah</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Buku </th>
                                            <th>Kategori</th>
                                            <th>ISBN</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sql = "SELECT buku.nama_buku, kategori.nama_kategori, buku.ISBN, buku.harga, buku.id_buku as bookid from buku join kategori on kategori.id_kategori = buku.id_kategori";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr class="odd gradeX">
                                                    <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->nama_buku); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->nama_kategori); ?></td>

                                                    <td class="center"><?php echo htmlentities($result->ISBN); ?></td>
                                                    <td class="center"><?php echo htmlentities($result->harga); ?></td>
                                                    <td class="center">

                                                        <a href="edit-buku.php<?php echo htmlentities($result->id_buku); ?>"><button class="btn btn-primary"><i class='bx bxs-pencil nav__icon__lite'></i>Edit</button>

                                                            <a href="manajemen-buku.php?del=<?php echo htmlentities($result->id_buku); ?>" onclick="return confirm('Anda yakin ingin menghapus buku ini?');"> <button class=" btn btn-danger"><i class='bx bxs-trash-alt nav__icon__lite'></i> Hapus</button>
                                                    </td>
                                                </tr>
                                        <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/script.php'); ?>
</body>

</html>