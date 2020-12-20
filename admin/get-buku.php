<?php
require_once("includes/config.php");
if (!empty($_POST["id_buku"])) {
  $id_buku = $_POST["id_buku"];

  $sql = "SELECT nama_buku,id_buku FROM buku WHERE (ISBN=:id_buku)"; //cek cek
  $query = $dbh->prepare($sql);
  $query->bindParam(':id_buku', $id_buku, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
      <option value="<?php echo htmlentities($result->id_buku); ?>"><?php echo htmlentities($result->nama_buku); ?></option>
      <b>Nama Buku:</b>
      <?php
      echo htmlentities($result->nama_buku);
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  } else { ?>
    <option class="others">Nomor ISBN Salah</option>
    <?php
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}
?>