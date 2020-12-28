<?php include('includes/config.php');
//admin login
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['adminlogin'])) {
    //captcha
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Kode Verifikasi Salah');</script>";
    } else {
        //login process
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT username,password FROM admin WHERE username=:username and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Silahkan Coba lagi');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/signIn.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Perpustakaan | Admin Login </title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <!-- ilustrasi -->
            <div class="login__img">
                <img src="assets/img/img-login.svg" alt="">
            </div>

            <!-- form login -->
            <div class="login__forms">
                <!-- admin login -->
                <form name="adminlogin" method="post" class="login__registre" id="admin-login">
                    <h1 class="login__title">Admin</h1>

                    <!-- username -->
                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Masukan Username" name="username" required autocomplete="off" class="login__input">
                    </div>

                    <!-- password -->
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" placeholder="Password" name="password" required autocomplete="off" class="login__input">
                    </div>

                    <!-- verif -->
                    <div class="login__box">
                        <i class='bx bx-check-shield login__icon'></i>
                        <input type="text" name="vercode" placeholder="Kode Verifikasi" maxlength="5" autocomplete="off" required class="login__input" />
                        <img src="captcha.php">
                    </div>

                    <!-- adminlogin button -->
                    <button href="admin/dashboard.php" class="login__button" type="submit" name="adminlogin">Masuk</button>

                    <!-- sign in option -->
                    <div>
                        <span class="login__account">Bukan admin?</span>
                        <a href="index.php" class="login__signin" id="sign-in">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <?php include('includes/script.php'); ?>
</body>

</html>