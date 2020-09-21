<!DOCTYPE html>
<html>
<head>
	<!--  This creates the Header -->
<div
class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font  color= 'Blue' size = 5px> <h2 class="center-block"> By Dates </h2> </font> </u>

<style>

body {

	text-align: center;
}

table,  td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;


}

label {
    display: block;
    font: 1rem 'Fira Sans', sans-serif;
}
input,
label {
    margin: .4rem 0;


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

	if(isset($_POST['sent_start']) and isset($_POST['sent_end'])){

		$start_date = $_POST['sent_start'];
		$end_date = $_POST['sent_end'];

		$sql_sent = "SELECT 	SUM(AMOUNT) AS TOTAL_AMOUNT
								 FROM			send_transaction
								 WHERE 		DATE_TIME >= '$start_date' AND DATE_TIME <= '$end_date' AND SSN = $ssn";

		$execute_sent = $dbConnected->query($sql_sent);

		if($execute_sent){
			$rows = $execute_sent->fetch_assoc();
			$total_sent = $rows['TOTAL_AMOUNT'];
		}else{
			$dbConnected->error;
		}

		if(empty($total_sent)){
			$total_sent = "No Entry For This Month";
		}else{
			$total_sent = "$".$total_sent;
		}

		if(isset($total_sent)){
		header("Location: bydates.php?ssn=".$ssn."&sent_val=".$total_sent);
	}
	}

	if(isset($_POST['req_start']) and isset($_POST['req_end'])){

		$start_date = $_POST['req_start'];
		$end_date = $_POST['req_end'];

		$sql_req = "SELECT 	SUM(AMOUNT) AS TOTAL_AMOUNT
								 FROM			request_transaction
								 WHERE 		DATE_TIME >= '$start_date' AND DATE_TIME <= '$end_date' AND SSN = $ssn";

		$execute_req = $dbConnected->query($sql_req);

		if($execute_req){
			$rows = $execute_req->fetch_assoc();
			$total_req = $rows['TOTAL_AMOUNT'];
		}else{
			$dbConnected->error;
		}

		if(empty($total_req)){
			$total_req = "No Entry For This Month";
		}else{
			$total_req = "$".$total_req;
		}

		if(isset($total_req)){
		header("Location: bydates.php?ssn=".$ssn."&req_val=".$total_req);
	}
	}

}
?>

<html>
<body>

<br>
<div class="back">
<a href = 'statements.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>
</br>



<form action="#" method="POST">
<table style="width:40%"  align="center">

<!-- Table Headers -->
<tr>
    <th><label for="start">Range of Dates: </label> </th>
    <th>Total Money Sent</th>
</tr>

<!-- Data Examples-->
<tr>
    <td>

    	<input type="date" id="start" name="sent_start" value="2020-01-01"
		min="2020-01-01" max="2020-12-31"> <p> To</p> </input>

    	<input type="date" id="start" name="sent_end" value="2020-01-01"
    	min="2020-01-02" max="2020-12-31"> </input>
			<br>
			<input type="submit" style="width: 50%; height: 5%;" class= "btn btn-primary" value="GET TOTAL"></input>

    </td>

    <td> <input type = "text" readonly="readonly" value="<?php if(isset($_GET['sent_val'])){echo $_GET['sent_val'];} ?>" placeholder="$$" text-align='center' /> </td>

</tr>
</form>


<form action="#" method="POST">


<!-- Table Headers -->
<tr>
    <th><label for="start">Range of Dates: </label> </th>
    <th>Total Money Requested</th>
</tr>

<!-- Data Examples-->
<tr>
    <td>

    	<input type="date" id="start" name="req_start" value="2020-01-01"
		min="2020-01-01" max="2020-12-31"> <p> To</p> </input>

    	<input type="date" id="start" name="req_end" value="2020-01-01"
    	min="2020-01-02" max="2020-12-31"> </input>
			<br>
			<input type="submit" style="width: 50%; height: 5%;" class= "btn btn-primary" value="GET TOTAL"></input>
    </td>

    <td> <input type = "text" readonly="readonly" value="<?php if(isset($_GET['req_val'])){echo $_GET['req_val'];} ?>" placeholder="$$" text-align='center' /> </td>

</tr>
</form>


</table>


<p> </p>
<div>
<a href = 'login.html'>
<button  type="submit"  style="float:right"> Sign Out </button> </a>
</div>


</body>
</html>
