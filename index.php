<?php include('includes/config.php');

//sign in session
if ($_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {
    //signin process
    $email = $_POST['email_siswa'];
    $password = md5($_POST['password']);
    $sql = "SELECT email_siswa, password, id_siswa, status FROM siswa WHERE email_siswa=:email and password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    //cek status
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['stdid'] = $result->id_siswa;
            if ($result->status == 1) {
                $_SESSION['login'] = $_POST['email_siswa'];
                echo "<script type='text/javascript'>
                    document.location = 'dashboard.php';
                    </script>";
            } else {
                echo "<script>alert('Akun anda telah diblokir. silahkan hubungi admin');</script>";
            }
        }
    } else {
        echo "<script>alert('Data tidak benar');</script>";
    }
}

//sign up
if (isset($_POST['signup'])) {
    //captcha
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Kode Salah, Coba Lagi');</script>";
    } else {
        //Generate ID Siswa
        $hitung_siswa = ("includes/id_siswa.txt");
        $hits = file($hitung_siswa);
        $hits[0]++;
        $fp = fopen($hitung_siswa, "w");
        fputs($fp, "$hits[0]");
        fclose($fp);
        $id_siswa = $hits[0];

        //signup process
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

        //generate ID Siswa
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Registrasi Sukses, berikut ID anda  "+"' . $id_siswa . '")</script>';
        } else {
            echo "<script>alert('Ada yang salah. Coba Lagi');</script>";
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
            <!-- ilustrasi -->
            <div class="login__img">
                <img src="assets/img/img-login.svg" alt="">
            </div>

            <!-- form login -->
            <div class="login__forms">
                <!-- sign in -->
                <form name="signin" method="post" class="login__registre" id="login-in">
                    <h1 class="login__title">Masuk</h1>

                    <!-- email -->
                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="text" placeholder="Masukan Email Anda" name="email_siswa" required autocomplete="off" class="login__input">
                    </div>

                    <!-- password -->
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" placeholder="Password" name="password" required autocomplete="off" class="login__input">
                    </div>

                    <!-- lupa pass -->
                    <a href="lupa-pass.php" class="login__forgot">Lupa password?</a>

                    <!-- login button -->
                    <button  class="login__button" type="submit" name="login">Masuk</button>

                    <!-- sign up option -->
                    <div>
                        <span class="login__account">Belum punya akun?</span>
                        <span class="login__signup" id="sign-up">Daftar</span>
                    </div>

                    <!-- admin login option -->
                    <div>
                        <span class="login__account">Apakah anda Admin?</span>
                        <a href="admin-login.php" class="login__signin" id="admin">Login Admin</a>
                    </div>
                </form>

                <!-- sign up -->
                <form name="signup" method="post" class="login__create none" id="login-up">
                    <h1 class="login__title">Buat Akun</h1>

                    <!-- nama -->
                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input name="nama" type="text" placeholder="Masukan Nama" autocomplete="off" required class="login__input">
                    </div>

                    <!-- email -->
                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input name="email" id="email_siswa" onBlur="cekEmail()" type="text" placeholder="Email" autocomplete="off" required class="login__input">
                        <span id="user-availability-status" style="font-size:12px;"></span>
                    </div>

                    <!-- notel -->
                    <div class="login__box">
                        <i class='bx bx-phone-call login__icon'></i>
                        <input name="notel" type="text" placeholder="Nomor Telepon" maxlength="12" autocomplete="off" required class="login__input">
                    </div>

                    <!-- password -->
                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input name="password" type="password" placeholder="Password" autocomplete="off" required class="login__input">
                    </div>

                    <!-- verif -->
                    <div class="login__box">
                        <i class='bx bx-check-shield login__icon'></i>
                        <input type="text" name="vercode" placeholder="Kode Verifikasi" maxlength="5" autocomplete="off" required class="login__input" />
                        <img src="captcha.php">
                    </div>

                    <!-- signup button -->
                    <button name="signup" type="submit" href="index.php" class="login__button">Daftar</button>

                    <!-- sign in option -->
                    <div>
                        <span class="login__account">Sudah punya akun ?</span>
                        <span class="login__signin" id="sign-in">Masuk</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===== MAIN JS =====-->
    <?php include('includes/script.php'); ?>
    
    <!-- cek email -->
    <script>
        function cekEmail() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "cek-email.php",
                data: 'email_siswa=' + $("#email_siswa").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</body>

</html>