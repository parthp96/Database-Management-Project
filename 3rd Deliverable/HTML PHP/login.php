<?php

$SQLhostname = "localhost";
$SQLusername = "root";
$SQLpassword = "kakashi@29";

$dbName = "test_wallet";

$dbConnected = mysqli_connect($SQLhostname, $SQLusername, $SQLpassword, $dbName);
//$dbSelect = mysqli_select_db($dbConnected, $dName);

$dbSucess = TRUE;
if (!$dbConnected){

	$dbSucess = FALSE;

}

if (isset($_POST["username"])) {

	$email = $_POST["username"];
	$password = $_POST["password"];

	$sql = "SELECT *
          FROM login_table
          WHERE login_id = '$email' AND password='$password'";

  $result = $dbConnected->query( $sql);

	if ($result->num_rows>0){
		$row = $result->fetch_assoc();
		header("Location: mainpage_new.php?ssn=".$row['SSN']);
	} else {
    header("Location: login.html");
    echo "Wrong Login ID password";
	}
	$dbConnected->close();

}

?>
