<?php
session_start();
error_reporting(0);
include('includes/config.php');

if ($_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {
        $email = $_POST['email_siswa'];
        $password = md5($_POST['password']);
        $sql = "SELECT email_siswa, password FROM siswa WHERE email_siswa=:email and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
            echo "<script>alert('Silahkan Coba lagi');</script>";
        }

        // if ($query->rowCount() > 0) {
        //     foreach ($results as $result) {
        //         $_SESSION['stdid'] = $result->id_siswa;
        //         if ($result->Status == 1) {
        //             $_SESSION['login'] = $_POST['email_siswa'];
        //             echo "<script type='text/javascript'>
        //             document.location = 'dashboard.php';
        //             </script>";
        //         } else {
        //             echo "<script>
        //             alert('Data tidak benar');
        //             </script>";
        //         }
        //     }
        // }
}

if (isset($_POST['signup'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Kode Salah, Coba Lagi');</script>";
    } else {
    //ID Siswa
    $hitung_siswa = ("includes/id_siswa.txt");
    $hits = file($hitung_siswa);
    $hits[0]++;
    $fp = fopen($hitung_siswa, "w");
    fputs($fp, "$hits[0]");
    fclose($fp);

    $id_siswa = $hits[0];
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $notelp = $_POST['notel'];
    $status = 1;
    $sql = "INSERT INTO siswa(id_siswa, nama_siswa, email_siswa, password, no_telp, status) VALUES(:id_siswa, :name, :email, :password, :notelp, :status)";
    $query = $dbh->prepare($sql);

    $query->bindParam(':id_siswa', $id_siswa, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':notelp', $notelp, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo '<script>alert("Registrasi Sukses, berikut ID anda  "+"' . $id_siswa . '")</script>';
    } else {
        echo "<script>alert('Ada yang salah. Coba Lagi');</script>";
    }
    }
}

if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['adminlogin'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
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

    <title>Perpustakaan | Login </title>
</head>

<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="assets/img/img-login.svg" alt="">
            </div>

            <div class="login__forms">
                <form name="signin" method="post" class="login__registre" id="login-in">
                    <h1 class="login__title">Masuk</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Masukan Email Anda" name="email_siswa" required autocomplete="off" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" placeholder="Password" name="password" required autocomplete="off" class="login__input">
                    </div>

                    <a href="#" class="login__forgot">Lupa password?</a>
                    <button href="dashboard.php" class="login__button" type="submit" name="login">Masuk</button>

                    <div>
                        <span class="login__account">Belum punya akun?</span>
                        <span class="login__signup" id="sign-up">Sign Up</span>
                    </div>

                    <div>
                        <span class="login__account">Apakah anda Admin?</span>
                        <span class="login__signin" id="admin">Admin Login</span>
                    </div>
                </form>

                <form name="signup" method="post" class="login__create none" id="login-up">
                    <h1 class="login__title">Buat Akun</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input name="nama" type="text" placeholder="Masukan Nama" autocomplete="off" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input name="email" type="text" placeholder="Email" autocomplete="off" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-phone-call login__icon'></i>
                        <input name="notel" type="text" placeholder="Nomor Telepon" maxlength="11" autocomplete="off" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input name="password" type="password" placeholder="Password" autocomplete="off" required class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-check-shield login__icon'></i>
                        <input type="text" name="vercode" placeholder="Kode Verifikasi" maxlength="5" autocomplete="off" required class="login__input" />
                        <img src="captcha.php">
                    </div>

                    <button name="signup" type="submit" href="index.php" class="login__button">Daftar</button>

                    <div>
                        <span class="login__account">Sudah punya akun ?</span>
                        <span class="login__signin" id="sign-in">Sign In</span>
                    </div>
                </form>

                <form name="adminlogin" method="post" class="login__registre none" id="admin-login">
                    <h1 class="login__title">Admin</h1>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Masukan Username" name="username" required autocomplete="off" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" placeholder="Password" name="password" required autocomplete="off" class="login__input">
                    </div>

                    <div class="login__box">
                        <i class='bx bx-check-shield login__icon'></i>
                        <input type="text" name="vercode" placeholder="Kode Verifikasi" maxlength="5" autocomplete="off" required class="login__input" />
                        <img src="captcha.php">
                    </div>

                    <button href="admin/dashboard.php" class="login__button" type="submit" name="adminlogin">Masuk</button>

                    <!-- <div>
                        <span class="login__account">Bukan admin?</span>
                        <span class="login__signin" id="sign-in">Sign In</span>
                    </div> -->
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <?php include('includes/script.php'); ?>
</body>

</html>