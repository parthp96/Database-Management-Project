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

	if(isset($_POST['email'])){

		$email = $_POST['email'];

		$amount = $_POST['get_amout'];
		$memo = $_POST['memo'];
		$percentage = $_POST['percentage'];
		$tid = rand(0, 99999);
		$date = date('Y-m-d h:i:s', time());

		$sql_request = "INSERT INTO request_transaction
										VALUES ('$tid', '$amount', '$date', '$memo','$ssn')";

		$sql_from = "INSERT INTO from_table
										 VALUES ('$tid', '$email', '$percentage')";

		$execute_request = $dbConnected->query($sql_request);
		$execute_from = $dbConnected->query($sql_from);

		if($execute_request and $execute_from){
			echo "MONEY REQUESTED!";
		}else{
			echo $dbConnected->error;
		}

	}

	elseif (isset($_POST['phone_num'])) {

		$phone_num = $_POST['phone_num'];
		$amount = $_POST['get_amout'];
		$memo = $_POST['memo'];
		$percentage = $_POST['percentage'];
		$tid = rand(0, 99999);
		$date = date('Y-m-d h:i:s', time());

		$sql_request = "INSERT INTO request_transaction
										VALUES ('$tid', '$amount', '$date', '$memo','$ssn')";

		$sql_from = "INSERT INTO from_table
										 VALUES ('$tid', '$phone_num', '$percentage')";

		$execute_request = $dbConnected->query($sql_request);
		$execute_from = $dbConnected->query($sql_from);

		if($execute_request and $execute_from){
			echo "MONEY REQUESTED!";
		}else{
			echo $dbConnected->error;
		}

	}
}

?>

<html>

	<head>

  <!-- This is the header code-->
<div class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font color = 'Green' size = 5px> <h2 class="center-block"> Request Money From: </h2> </font> </u>
</div>

<style>

body {

	text-align: center;
}

</style>

	</head>

	<body>

<!-- Back Button -->

<div class="back">
<a href = 'mainpage_new.php?ssn=<?php echo $ssn ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>


<!-- The user's email and amount who we are sending the money -->
<form action="#" method="POST">

	<table>

		<tr>
				<h3>SENDER EMAIL
				<input type="text" name="email" style="width: 10%;" placeholder="Receiver Email" required>
				&nbsp AMOUNT
				<input type="text" name="get_amout" placeholder="Amount To Receive" required>
				&nbsp Memo
				<input type="text" name="memo" style="width: 20%;" placeholder="Write Memo" required>
				&nbsp PERCENTAGE
				<input type="text" name="percentage" style="width: 5%;" placeholder="Percentage" required>
				<input type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" value="SEND">
				</h3>

		</tr>

	</table>

</form>


<p> OR (--Please use only one--) </p>

<!-- The user;s phone and amount who we are sending the money  -->
<form action="#" method="POST">

	<table>

		<tr>
				<h3>SENDER PHONE NUMBER
				<input type="text" name="phone_num" style="width: 10%;" placeholder="Receiver PhoneNumber" required>
				&nbsp AMOUNT
				<input type="text" name="get_amout" placeholder="Amount To Receive" required>
				&nbsp Memo
				<input type="text" name="memo" style="width: 20%;" placeholder="Write Memo" required>
				&nbsp PERCENTAGE
				<input type="text" name="percentage" style="width: 5%;" placeholder="Percentage" required>
				<input type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" value="SEND">
				</h3>

		</tr>

	</table>

</form>

<!-- Sign Out Form   -->
  <!-- change the text after 'file:///' to where-ever you keep the files. keep them all in one location, prerebaly in a WALLET folder on desktop' -->

<div class="sign-out">
<a href = 'login.html'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Sign Out </button> </a>
</div>

	</body>
</html>
