<?php include('includes/config.php');
if (isset($_POST['add'])) {
    $idsiswa = strtoupper($_POST['idsiswa']);
    $id_buku = $_POST['detailBuku'];
    $sql = "INSERT INTO peminjaman(id_siswa, id_buku) VALUES(:idsiswa,:id_buku)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':idsiswa', $idsiswa, PDO::PARAM_STR);
    $query->bindParam(':id_buku', $id_buku, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $_SESSION['msg'] = "Buku Dipinjamkan";
        header('location:manajemen-peminjaman.php');
    } else {
        $_SESSION['error'] = "Ada yang salah, Silahkan Coba Lagi";
        header('location:manajemen-peminjaman.php');
    }
}
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

    <title>Perpustakaan | Manajemen Peminjaman</title>
    <script>
        // function for get student name
        function getSiswa() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "get-siswa.php",
                data: 'idsiswa=' + $("#idsiswa").val(),
                type: "POST",
                success: function(data) {
                    $("#get_student_name").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }

        //function for book details
        function getBuku() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "get-buku.php",
                data: 'id_buku=' + $("#id_buku").val(),
                type: "POST",
                success: function(data) {
                    $("#get_book_name").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
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
                    <h4 class="header-line">Peminjaman Buku Baru</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                    <div class=" panel panel-info">
                        <div class="panel-heading">
                            Peminjaman Buku Baru
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Student id<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="idsiswa" id="idsiswa" onBlur="getSiswa()" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Nomor ISBN/Judul Buku<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="id_buku" id="id_buku" onBlur="getBuku()" required="required" />
                                </div>

                                <div class="form-group">
                                    <select class="form-control" name="detailBuku" id="get_book_name" readonly></select>
                                </div>
                                <button type="submit" name="add" id="submit" class="btn btn-info">Tambah </button>
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