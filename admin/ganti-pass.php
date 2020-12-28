<?php include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location: ../index.php');
} else {
    if (isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT password FROM admin where username=:username and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update admin set password=:newpassword where username=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Password anda berhasil diubah";
        } else {
            $error = "Password anda salah";
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

        <title>Perpustakaan | Ganti password</title>
    </head>

    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img href="profil.php" src="assets/Img/profile.png" alt="">
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

                        <a href="manajemen-peminjaman.php" class="nav__link">
                            <i class='bx bxs-cart-add nav__icon'></i>
                            <span class="nav__name">Peminjaman</span>
                        </a>

                        <a href="anggota.php" class="nav__link">
                            <i class='bx bxs-user nav__icon'></i>
                            <span class="nav__name">Anggota</span>
                        </a>

                        <a href="ganti-pass.php" class="nav__link active">
                            <i class='bx bxs-key nav__icon'></i>
                            <span class="nav__name">Ganti password</span>
                        </a>
                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Ganti password</h4>
                </div>
            </div>

            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Ganti password
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                                <div class="form-group">
                                    <label>password Lama</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>password baru</label>
                                    <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi password </label>
                                    <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                                </div>

                                <button type="submit" name="change" class="btn btn-info">Ganti</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <?php include('includes/script.php'); ?>
        <!-- Change Pass  -->
        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("password baru dan konfirmasi password berbeda!!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </body>

    </html>
<?php } ?>