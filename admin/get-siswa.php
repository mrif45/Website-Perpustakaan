<?php
require_once("includes/config.php");
if (!empty($_POST["idsiswa"])) {
  $idsiswa = strtoupper($_POST["idsiswa"]);

  $sql = "SELECT nama_siswa, status FROM siswa WHERE id_siswa=:idsiswa";
  $query = $dbh->prepare($sql);
  $query->bindParam(':idsiswa', $idsiswa, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      if ($result->status == 0) {
        echo "<span style='color:red'> ID Siswa telah diblokir</span>" . "<br />";
        echo "<b>Nama Siswa -</b>" . $result->nama_siswa;
        echo "<script>$('#submit').prop('disabled',true);</script>";
      } else {
?><?php
              echo htmlentities($result->nama_siswa);
              echo "<script>$('#submit').prop('disabled',false);</script>";
            }
          }
        } else {
          echo "<span style='color:red'> Id Siswa Salah. Masukan id yang benar!!! .</span>";
          echo "<script>$('#submit').prop('disabled',true);</script>";
        }
      }
?>
