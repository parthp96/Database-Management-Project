<html>

<head>
<!-- the code below is the sheet to put all the code in the center of the page...-->
<div
class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font color= 'Purple' size = 5px> <h2 class="center-block"> Main Page </h2> </font> </u>
</div>


<style>

body {

text-align: center;
}

</style>


</head>

</html>

<?php

$SQLhostname = "localhost";
$SQLusername = "root";
$SQLpassword = "kakashi@29";

$dbName = "test_wallet";

$dbConnected = mysqli_connect($SQLhostname, $SQLusername, $SQLpassword, $dbName);
//$dbSelect = mysqli_select_db($dbConnected, $dName);

$ssn = $_GET['ssn'];

$dbSucess = TRUE;
if (!$dbConnected){

	$dbSucess = FALSE;

}

if (isset($ssn)) {

	$sql = "SELECT Name, Balance, BankID, BANumber
          FROM user_account
          WHERE SSN = '$ssn'";

  $result = $dbConnected->query($sql);

	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		echo "Name: ".$row['Name']."<br>Balance: ".$row['Balance']."<br>BANK ID: ".$row['BankID']."<br>BANK NUMBER: ".$row['BANumber']."<br><br><br>";
	} else {
		$row = $result->fetch_assoc();
		echo "Name: ".$row['Name']." Balance: ".$row['Balance'];
    echo "Wrong Login ID password";
	}
	$dbConnected->close();

}

?>

<html>

<body>

<!-- buttons to take us to different pages -->

<!-- Account Information Page Button -->

<!--

<div class="form-group">

<Button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="ACCOUNT"> Account Info </Button>
</div>

<p> </p>
-->
<!-- ACCOUNT INFO -->

<div class="form-group">
<a href = 'accountinfo.php?ssn=<?php echo $ssn?>'>
<button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="send"> Account Info </button> </a>
</div>

<p> </p>


<!-- Sending Money to Someone Page Button -->

<div class="form-group">
<a href = 'sendmoney.php?ssn=<?php echo $ssn?>'>
<button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="send"> Send Money </button> </a>
</div>

<p> </p>

<!-- Requesting Money from Someone Page Button -->
<div class="form-group">
<a href = 'requestmoney.php?ssn=<?php echo $ssn?>'>
<button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="request"> Request Money </button> </a>
</div>

<p> </p>

<!--Statements for transactions Page Button-->
<div class="form-group">
<a href = 'statements.php?ssn=<?php echo $ssn?>'>

<button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="statement"> Statements </button>
</a>
</div>
<p> </p>

<!-- Search Transactions Page Button -->
<div class="form-group">
<a href = 'searchtransaction.php?ssn=<?php echo $ssn?>'>
<button type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" name="REG"> Search Transactions </button></a>
</div>

<p></p>

<div class="sign-out">
<a href = 'login.html'>
<Button  style="width: 10%; height: 5%;" type="submit" class= "btn btn-primary"  name="REG" style="float:right" > Sign Out </Button> </a>
</div>
	</body>
</html>
