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

    <title>Perpustakaan | Ganti Password</title>
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

                    <a href="peminjaman.php" class="nav__link">
                        <i class='bx bxs-cart-add nav__icon'></i>
                        <span class="nav__name">Peminjaman</span>
                    </a>

                    <a href="profil.php" class="nav__link">
                        <i class='bx bxs-user nav__icon'></i>
                        <span class="nav__name">Profil</span>
                    </a>

                    <a href="ganti-pass.php" class="nav__link active">
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

    <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Ganti Password</h4>
            </div>
        </div>

        <!-- error message -->
        <?php if ($error) { ?>
            <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
            </div><?php
                } else if ($msg) { ?>
            <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Ganti Password
                    </div>

                    <div class="panel-body">
                        <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                            <!-- password sekarang -->
                            <div class="form-group">
                                <label>Password Sekarang</label>
                                <input class="form-control" type="password" name="password" autocomplete="off" required />
                            </div>

                            <!-- password baru -->
                            <div class="form-group">
                                <label>Password baru</label>
                                <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                            </div>

                            <!-- konfirmasi password -->
                            <div class="form-group">
                                <label>Konfirmasi Password </label>
                                <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                            </div>

                            <!-- change button -->
                            <button type="submit" name="change" class="btn btn-info">Ganti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php include('includes/script.php'); ?>
    <!-- Change Pass Script -->
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("Password baru dan konfirmasi password berbeda!!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</body>

</html>