<html>

<head>

<!-- This is the header code-->
<div class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font color = 'Green' size = 5px> <h2 class="center-block">ACCOUNT INFO</h2> </font> </u>
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

$dbSucess = TRUE;
if (!$dbConnected){

	$dbSucess = FALSE;

}

if (isset($_GET['ssn'])) {

  $ssn = $_GET['ssn'];

  $sql_user_account =  "SELECT Name, SSN, Balance, PhoneNo, BankID, BANumber
                        FROM user_account
                        WHERE SSN = '$ssn'";

  $sql_email = "SELECT EmailAdd
                FROM   email
                WHERE  SSN = '$ssn'";

  $result = $dbConnected->query($sql_user_account);
  $result_email = $dbConnected->query($sql_email);

	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		echo "Name: ".$row['Name']."<br>SSN: ".$row['SSN']."<br>Balance: ".$row['Balance']."<br>Phone Number: ".$row['PhoneNo']."<br>BANK ID: ".$row['BankID']."<br>BANK NUMBER: ".$row['BANumber'];
	} else {
		$row = $result->fetch_assoc();
    //echo $ssn;
		echo "Name: ".$row['Name']." Balance: ".$row['Balance'];
    echo "Wrong Login ID password";
	}

  if ($result_email->num_rows > 0){
		$row = $result_email->fetch_assoc();
		echo "<br>Email: ".$row['EmailAdd']."<br><br><br>";
	}


	// CHANGE NAME

  if(isset($_POST['new_name'])){

    $new_name = $_POST['new_name'];

    $sql_change_name = "UPDATE user_account
                        SET    Name = '$new_name'
                        WHERE  SSN = '$ssn'";

    $execute_change_name = $dbConnected->query($sql_change_name);

    if($execute_change_name){
      header("Location: accountinfo.php?ssn=".$ssn);
    }

  }

  //CHANGE SSN

  if(isset($_POST['new_ssn'])){

    $new_ssn = $_POST['new_ssn'];

    $sql_change_ssn = "UPDATE user_account
                        SET    SSN = '$new_ssn'
                        WHERE  SSN = '$ssn'";

    $execute_change_ssn = $dbConnected->query($sql_change_ssn);

    if($execute_change_ssn){
      header("Location: accountinfo.php?ssn=".$new_ssn);
      //echo "SSN Updated to ".$new_ssn;
    }else{
      echo $dbConnected->error;
    }

  }

  // ADD EMAIL ADDRESS

  if(isset($_POST['email_add'])){

    $new_email = $_POST['email_add'];

    $sql_EA = "INSERT INTO elec_address
               VALUES    ('$new_email', 0)";

    $sql_email = "INSERT INTO email
                  VALUES    ('$new_email', '$ssn')";

    $execute_EA = $dbConnected->query($sql_EA);
    $execute_email = $dbConnected->query($sql_email);

    if($execute_EA and $execute_email){
      header("Location: accountinfo.php?ssn=".$ssn);
      //echo "SSN Updated to ".$new_ssn;
    }else{
      echo $dbConnected->error;
    }

  }

  // REMOVE EMAIL ADDRESS
    if(isset($_POST['email_remove'])){

      $remove_email = $_POST['email_remove'];

      $sql_EA = "DELETE FROM elec_address
                 WHERE Identifier = '$remove_email'";

      $sql_email = "DELETE FROM email
                    WHERE EmailAdd = '$remove_email'";

      $execute_EA = $dbConnected->query($sql_EA);
      $execute_email = $dbConnected->query($sql_email);

      if($execute_EA and $execute_email){
        header("Location: accountinfo.php?ssn=".$ssn);
        //echo "SSN Updated to ".$new_ssn;
      }else{
        echo $dbConnected->error;
      }

  }


  // ADD PHONE NUMBER

  if(isset($_POST['phoneNo_add'])){

    $new_no = $_POST['phoneNo_add'];

    $sql_EA = "INSERT INTO elec_address
               VALUES    ('$new_no', 0)";

    $sql_phone = "INSERT INTO phone
                  VALUES    ('$new_no')";

		$sql_UA = "UPDATE user_account
							 SET 		PhoneNo = '$new_no'
							 WHERE 	SSN = $ssn AND PhoneNo IS NULL";

		 $sql_ST = "UPDATE send_transaction
								SET 		Identifier = '$new_no'
								WHERE 	Identifier IS NULL";

    $execute_EA = $dbConnected->query($sql_EA);
    $execute_phone = $dbConnected->query($sql_phone);
		$execute_UA = $dbConnected->query($sql_UA);
		$execute_ST = $dbConnected->query($sql_ST);

    if($execute_EA and $execute_phone and $execute_UA and $execute_ST){
      header("Location: accountinfo.php?ssn=".$ssn);
      //echo "SSN Updated to ".$new_ssn;
    }else{
      echo $dbConnected->error;
    }

  }

  // REMOVE PHONE NUMBER
    if(isset($_POST['phoneNo_remove'])){

      $remove_no = $_POST['phoneNo_remove'];

      $sql_EA = "DELETE FROM elec_address
                 WHERE Identifier = '$remove_no'";

      $sql_phone = "DELETE FROM phone
                    WHERE PhoneNo = '$remove_no'";

      $execute_EA = $dbConnected->query($sql_EA);
      $execute_phone = $dbConnected->query($sql_email);

      if($execute_EA and $execute_phone){
        header("Location: accountinfo.php?ssn=".$ssn);
        //echo "SSN Updated to ".$new_ssn;
      }else{
        echo $dbConnected->error;
      }

  }


	// ADD BANK ACCOUNT
    if(isset($_POST['bankacc_add']) and isset($_POST['bankno_add'])){

      $new_acc = $_POST['bankacc_add'];
			$new_bankNo = $_POST['bankno_add'];

			$sql_BA = "INSERT INTO bank_account
	               VALUES    ('$new_acc', '$new_bankNo')";

	    $sql_HA = "INSERT INTO has_additional
	               VALUES    ('$ssn', '$new_acc', '$new_bankNo', 0)";

			$sql_UA = "UPDATE user_account
								 SET 		BankID = '$new_acc', BANumber = '$new_bankNo', Balance=99999
								 WHERE 	SSN = $ssn AND BankID IS NULL AND BANumber IS NULL";

      $execute_BA = $dbConnected->query($sql_BA);
			$execute_HA = $dbConnected->query($sql_HA);
      $execute_UA = $dbConnected->query($sql_UA);

      if($execute_BA and $execute_HA and $execute_UA){
        header("Location: accountinfo.php?ssn=".$ssn);
        //echo "SSN Updated to ".$new_ssn;
      }else{
        echo $dbConnected->error;
      }

  }

	// REMOVE BANK ACCOUNT
	if(isset($_POST['bankacc_remove']) and isset($_POST['bankno_remove'])){

		$remove_acc = $_POST['bankacc_remove'];
		$remove_bankNo = $_POST['bankno_remove'];;

		$sql_BA = "DELETE FROM bank_account
							 WHERE BankID = '$remove_acc' and BANumber='$remove_bankNo'";

		$sql_HA = "DELETE FROM has_additional
							 WHERE BankID = '$remove_acc' and BANumber='$remove_bankNo' and SSN = '$ssn'";

		$execute_BA = $dbConnected->query($sql_BA);
		$execute_HA = $dbConnected->query($sql_HA);

		if($execute_BA and $execute_HA){
			header("Location: accountinfo.php?ssn=".$ssn);
			//echo "SSN Updated to ".$new_ssn;
		}else{
			echo $dbConnected->error;
		}

}



	}

?>


<html>

	<body>

<!-- Back Button -->

<div class="back">
<a href = 'mainpage_new.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>



<form action="#" method="POST">

	<table>

		<tr>

        <!-- Change NAME -->
        <h3>CHANGE NAME
        <input type="text" name="new_name" style="width: 10%;" placeholder="NAME" >
        <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="UPDATE NAME">
        </h3>

		</tr>

	</table>

</form>

<form action="#" method="POST">

  <table>
    <tr>

      <!-- Change SSN -->
      <h3>CHANGE SSN
      <input type="text" name="new_ssn" style="width: 10%;" placeholder="SSN" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="UPDATE SSN">
      </h3>

    </tr>

  </table>

</form>


<form action="#" method="POST">

  <table>
    <tr>

      <!-- ADD Email Address -->
      <h3>ADD EMAIL
      <input type="text" name="email_add" style="width: 10%;" placeholder="Email" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="ADD EMAIL">
      </h3>

    </tr>

  </table>

</form>

<p> OR </p>

<form action="#" method="POST">

  <table>
    <tr>

      <!-- REMOVE Email Address -->
      <h3>REMOVE EMAIL
      <input type="text" name="email_remove" style="width: 10%;" placeholder="Email" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="REMOVE EMAIL">
      </h3>

    </tr>

  </table>

</form>

<form action="#" method="POST">

  <table>
    <tr>

      <!-- ADD Phone Number -->
      <h3>ADD PHONE NUMBER
      <input type="text" name="phoneNo_add" style="width: 10%;" placeholder="Phone Number" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="ADD NUMBER">
      </h3>

    </tr>

  </table>

</form>
<p>OR</p>

<form action="#" method="POST">

  <table>
    <tr>

      <!-- REMOVE Phone Number -->
      <h3>REMOVE PHONE NUMBER
      <input type="text" name="phoneNo_remove" style="width: 10%;" placeholder="Phone Number" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="REMOVE NUMBER">
      </h3>

    </tr>

  </table>

</form>



<form action="#" method="POST">

  <table>
    <tr>

      <!-- ADD Bank Account -->
      <h3>ADD BANK ACCOUNT
      <input type="text" name="bankacc_add" style="width: 10%;" placeholder="Bank Account Number" >
			<input type="text" name="bankno_add" style="width: 10%;" placeholder="Bank Number" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="ADD ACCOUNT">
      </h3>

    </tr>

  </table>

</form>

<p> OR </p>
<form action="#" method="POST">

  <table>
    <tr>

      <!-- REMOVE Bank Account -->

      <h3>REMOVE BANK ACCOUNT
      <input type="text" name="bankacc_remove" style="width: 10%;" placeholder="Bank Account Number" >
			<input type="text" name="bankno_remove" style="width: 10%;" placeholder="Bank Number" >
      <input type="submit" style="width: 20%; height: 5%;" class= "btn btn-primary" value="REMOVE ACCOUNT">
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
