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

		 $amount = $_POST['sent_amout'];
		 $memo = $_POST['memo'];
 		 $sql_receiver = "UPDATE user_account
 										 	SET Balance = Balance + '$amount'
 										 	WHERE SSN IN
											(SELECT SSN
											 FROM 	email
										 	 WHERE	EmailAdd = '$email')";

 		 $sql_sender = "UPDATE user_account
 									 	SET Balance = Balance - '$amount'
 									 	WHERE SSN = '$ssn'";

		 $tid = rand(0, 99999);
		 $date = date('Y-m-d h:i:s', time());

		 $sql_record = "INSERT INTO send_transaction
		 								VALUES ('$tid', '$amount', '$date', '$memo', NULL, '$email', '$ssn')";

		$execute_record = $dbConnected->query($sql_record);

			if($execute_record){
				$execute_receiver = $dbConnected->query($sql_receiver);
				$execute_sender = $dbConnected->query($sql_sender);

				echo "MONEY SENT!";
			}else{
				echo $dbConnected->error;
			}

	}

	elseif (isset($_POST['phone_num'])) {

		$phone_num = $_POST['phone_num'];
		$amount = $_POST['sent_amout'];
		$memo = $_POST['memo'];
		$sql_receiver = "UPDATE user_account
										 SET Balance = Balance + '$amount'
										 WHERE PhoneNo = '$phone_num'";

		$sql_sender = "UPDATE user_account
									 SET Balance = Balance - '$amount'
									 WHERE SSN = '$ssn'";


	 	$tid = rand(0, 99999);
		$date = date('Y-m-d h:i:s', time());

		$sql_record = "INSERT INTO send_transaction
									 VALUES ('$tid', '$amount', '$date', '$memo', NULL, '$phone_num', '$ssn')";

		$execute_record = $dbConnected->query($sql_record);

		if($execute_record){
			$execute_receiver = $dbConnected->query($sql_receiver);
			$execute_sender = $dbConnected->query($sql_sender);

			echo "MONEY SENT!";
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
<u> <font color = 'Green' size = 5px> <h2 class="center-block">Send Money To: </h2> </font> </u>
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
<a href = 'mainpage_new.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>


<!-- The user's email and amount who we are sending the money -->

<form action="#" method="POST">

	<table>

		<tr>
				<h3>RECEIVER EMAIL
				<input type="text" name="email" style="width: 10%;" placeholder="Receiver Email" required>
				&nbsp AMOUNT
				<input type="text" name="sent_amout" placeholder="Amount To Send" required>
				&nbsp Memo
				<input type="text" name="memo" style="width: 20%;" placeholder="Write Memo" required>
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
				<h3>RECEIVER PHONE NUMBER
				<input type="text" name="phone_num" style="width: 10%;" placeholder="Receiver PhoneNumber" required>
				&nbsp AMOUNT
				<input type="text" name="sent_amout" placeholder="Amount To Send" required>
				&nbsp Memo
				<input type="text" name="memo" style="width: 20%;" placeholder="Write Memo" required>
				<input type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" value="SEND">
				</h3>

		</tr>

	</table>

</form>

<!-- Sign Out Form   -->
  <!-- change the text after 'file:///' to where-ever you keep the files. keep them all in one location, prerebaly in a WALLET folder on desktop' -->

<div class="sign-out">
<a href = 'login.html'>
<button type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Sign Out </button> </a>
</div>

	</body>
</html>
