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

	if(isset($_POST['Month'])){

		$month_name = $_POST['Month'];

		$sql_sent_sum = "SELECT 	SUM(AMOUNT) AS TOTAL_AMOUNT
								 FROM			send_transaction
								 WHERE 		MONTHNAME(DATE_TIME) = '$month_name' AND SSN = $ssn";

	 $sql_sent_avg = "SELECT 	AVG(AMOUNT) AS AVG_AMOUNT
								 FROM			send_transaction
								 WHERE 		MONTHNAME(DATE_TIME) = '$month_name' AND SSN = $ssn";

	 $sql_req = "SELECT 	SUM(AMOUNT) AS TOTAL_AMOUNT, AVG(AMOUNT) AS AVG_AMOUNT
							 FROM			request_transaction
							 WHERE 		MONTHNAME(DATE_TIME) = '$month_name' AND SSN = $ssn";

		$execute_sent_total = $dbConnected->query($sql_sent_sum);
		$execute_sent_avg = $dbConnected->query($sql_sent_avg);
		$execute_req = $dbConnected->query($sql_req);


		if($execute_sent_total){
			$rows = $execute_sent_total->fetch_assoc();
			$total_sent_sum = $rows['TOTAL_AMOUNT'];
		}else{
			$dbConnected->error;
		}

		if($execute_sent_avg){
			$rows = $execute_sent_avg->fetch_assoc();
			$total_sent_avg = $rows['AVG_AMOUNT'];
		}else{
			$dbConnected->error;
		}

		if($execute_req){
			$rows = $execute_req->fetch_assoc();
			$total_req = $rows['TOTAL_AMOUNT'];
			$avg_req = $rows['AVG_AMOUNT'];
		}else{
			$dbConnected->error;
		}

		if(empty($total_sent_sum)){
			$total_sent_sum = "No Entry For This Month";
		}else{
			$total_sent_sum = "$".$total_sent_sum;
		}

		if(empty($total_sent_avg)){
			$total_sent_avg = "No Entry For This Month";
		}else{
			$total_sent_avg = "$".$total_sent_avg;
		}

		if(empty($total_req)){
			$total_req = "No Entry For This Month";
		}else{
			$total_req = "$".$total_req;
		}

		if(empty($avg_req)){
			$avg_req = "No Entry For This Month";
		}else{
			$avg_req = "$".$avg_req;
		}

		if(isset($total_sent_sum) and isset($total_sent_avg) and isset($total_req) and isset($avg_req)){
		header("Location: bymonth.php?ssn=".$ssn."&total_sent=".$total_sent_sum."&avg_sent=".$total_sent_avg."&total_req=".$total_req."&avg_req=".$avg_req);
	}
	}

}

?>



<!DOCTYPE html>
<html>
<head>
	<!--  This creates the Header -->
<div
class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font  color= 'Blue' size = 5px> <h2 class="center-block"> By Month </h2> </font> </u>
</div>
<style>

body {

	text-align: center;

}



.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.block {
  display: block;
  width: 100%;
  border: none;
  background-color: rgba();
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

table,  td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;


}

</style>

</head>

<body>

<br>
<div class="back">
<a href = 'statements.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>
</br>


<form action="#" method="POST">
  <label for="Month">Choose A Month:</label>
  <select id="Month" name="Month">
    <option name="January">January</option>
    <option name="Febuary">Febuary</option>
    <option name="March">March</option>
		<option name="April">April</option>
		<option name="May">May</option>
		<option name="June">June</option>
		<option name="July">July</option>
		<option name="August">August</option>
		<option name="September">September</option>
		<option name="October">October</option>
		<option name="November">November</option>
    <option name="December">December</option>
  </select>
	<input type="submit" style="width: 10%; height: 5%;" class= "btn btn-primary" value="SELECT MONTH">
</form>

<br><br><br>

<div>
<a href = 'login.html'>
<button  type="submit"  style="float:right"> Sign Out </button> </a>
</div>

<p></p>

<table style="width:40%"  align="left">

<!-- Table Headers -->
<tr>
    <th>Total Money Sent</th>
    <th>Average Money Sent</th>
</tr>

<!-- Data Examples-->
<tr>
    <td><?php if(isset($_GET['total_sent'])){echo $_GET['total_sent'];}else{echo "$$";} ?></td>
    <td><?php if(isset($_GET['avg_sent'])){echo $_GET['avg_sent'];}else{echo "$$";} ?></td>
</tr>

</table>
<p></p>

<p></p>

<!-- Table Headers -->

<table style="width:40%" align="right">

<tr>
    <th>Total Money Received</th>
    <th>Average Money Received</th>
</tr>

<!-- Data Examples-->
<tr>
    <td><?php if(isset($_GET['total_req'])){echo $_GET['total_req'];}else{echo "$$";} ?></td>
    <td><?php if(isset($_GET['avg_req'])){echo $_GET['avg_req'];}else{echo "$$";} ?></td>
</tr>

</table>


</body>
</html>
