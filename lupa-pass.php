<?php include('includes/config.php');
if (isset($_POST['signin'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $email = $_POST['email'];
        $mobile = $_POST['notel'];
        $newPass = md5($_POST['newPass']);
        $sql = "SELECT email_siswa FROM siswa WHERE email_siswa=:email and no_telp=:notel";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':notel', $notel, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update siswa set password=:newpassword where email_siswa=:email and MobileNumber=:notel";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':notel', $notel, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newPass', $newPass, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo "<script>alert('Password anda berhasil disimpan');</script>";
        } else {
            echo "<script>alert('Email atau No Telepon salah');</script>";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="assets/css/signIn.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Perpustakaan | Lupa Password </title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <!-- ilustrasi -->
            <div class="login__img">
                <img src="assets/img/img-login.svg" alt="">
            </div>

            <!-- form lupa password -->
            <div class="login__forms">
                <form name="chngpwd" method="post" class="login__create" id="login-in">
                    <h1 class="login__title">Lupa Password</h1>

                    <!-- email -->
                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input name="email" type="text" placeholder="Email" autocomplete="off" required class="login__input">
                    </div>

                    <!-- notel -->
                    <div class="login__box">
                        <i class='bx bx-phone-call login__icon'></i>
                        <input name="notel" type="text" placeholder="Nomor Telepon" maxlength="12" autocomplete="off" required class="login__input">
                    </div>

                    <!-- password -->
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input name="newPass" type="password" placeholder="Password Baru" autocomplete="off" required class="login__input">
                    </div>

                    <!-- password -->
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input name="confirmpassword" type="password" placeholder="Konfirmasi Password" autocomplete="off" required class="login__input">
                    </div>

                    <!-- verif -->
                    <div class="login__box">
                        <i class='bx bx-check-shield login__icon'></i>
                        <input type="text" name="vercode" placeholder="Kode Verifikasi" maxlength="5" autocomplete="off" required class="login__input" />
                        <img src="captcha.php">
                    </div>

                    <!-- signin button -->
                    <button name="signin" type="submit" href="index.php" class="login__button">Masuk</button>

                    <!-- sign in option -->
                    <div>
                        <span class="login__account">Tidak lupa password?</span>
                        <a href="index.php" class="login__signin" id="sign-in">Masuk</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <?php include('includes/script.php'); ?>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newPass.value != document.chngpwd.confirmpassword.value) {
                alert("Konfirmasi dan Password baru tidak sama !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</body>

</html>