<?php 
require_once("includes/config.php");

// email availablity
if(!empty($_POST["email_siswa"])) {
	$email= $_POST["email_siswa"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
		echo "Error : Email anda tidak benar.";
	} else {
		$sql ="SELECT email_siswa FROM siswa WHERE email_siswa=:email";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':email', $email, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query -> rowCount() > 0){
			echo "<i style='color:red' class='bx bxs-x-square login__icon'></i>";
			echo "<span style='color:red'>email sudah ada</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else{	
			echo "<i style='color:green' class='bx bxs-check-circle login__icon' ></i>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
