<html>
	<head>
<div class="back">
<a href = 'mainpage_new.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>

<!--  This creates the Header -->
<br>
<div
class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font  color= 'Blue' size = 5px> <h2 class="center-block"> Statements </h2> </font> </u>

</div>

<style>

body {

	text-align: center;
}

table,  td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;

}
p {

    font-weight:bold;
    font
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


	$sql_best_sent = "SELECT 		MAX_TABLE.Name AS NAME, MAX_TABLE.TOTAL_AMOUNT AS TOT_AMT
										FROM	 		(SELECT		UA.Name, SUM(ST.AMOUNT) AS TOTAL_AMOUNT
															FROM			user_account AS UA, send_transaction AS ST
															WHERE			UA.SSN = ST.SSN
															GROUP BY	UA.SSN) AS MAX_TABLE
										ORDER BY  MAX_TABLE.TOTAL_AMOUNT DESC";

	$sql_best_received = "SELECT 		MAX_TABLE.Name AS NAME, MAX_TABLE.TOTAL_AMOUNT AS TOT_AMT
										FROM	 		(SELECT		UA.Name, SUM(RT.AMOUNT) AS TOTAL_AMOUNT
															FROM			user_account AS UA, request_transaction AS RT
															WHERE			UA.SSN = RT.SSN
															GROUP BY	UA.SSN) AS MAX_TABLE
										ORDER BY  MAX_TABLE.TOTAL_AMOUNT DESC";

	$result_best_sent = $dbConnected->query($sql_best_sent);
	$result_best_received = $dbConnected->query($sql_best_received);

	if($result_best_sent){
		$rows = $result_best_sent->fetch_assoc();
		$best_sent_name = $rows['NAME'];
	}else{
		echo "FAIL";
		echo $dbConnected->error;
	}

	if($result_best_received){
		$rows = $result_best_received->fetch_assoc();
		$best_received_name = $rows['NAME'];
	}else{
		echo $dbConnected->error;
	}

	// SELECT MAX AMOUNT SENT FOR JANUARY

	$sql_sent_jan = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		send_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'January' AND SSN = $ssn";
	$execute_sent_jan = $dbConnected->query($sql_sent_jan);

	if($execute_sent_jan){
		$rows = $execute_sent_jan->fetch_assoc();
		$max_sent_jan = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_sent_jan)){
		$max_sent_jan = "No Entry For This Month";
	}else{
		$max_sent_jan = "$".$max_sent_jan;
	}

	// SELECT MAX AMOUNT SENT FOR FEBRUARY

	$sql_sent_feb = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		send_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'February' AND SSN = $ssn";
	$execute_sent_feb = $dbConnected->query($sql_sent_feb);

	if($execute_sent_feb){
		$rows = $execute_sent_feb->fetch_assoc();
		$max_sent_feb = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_sent_feb)){
		$max_sent_feb = "No Entry For This Month";
	}else{
		$max_sent_feb = "$".$max_sent_feb;
	}

	// SELECT MAX AMOUNT SENT FOR MARCH

	$sql_sent_march = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		send_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'March' AND SSN = $ssn";
	$execute_sent_march = $dbConnected->query($sql_sent_march);

	if($execute_sent_march){
		$rows = $execute_sent_march->fetch_assoc();
		$max_sent_march = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_sent_march)){
		$max_sent_march = "No Entry For This Month";
	}else{
		$max_sent_march = "$".$max_sent_march;
	}

	// SELECT MAX AMOUNT SENT FOR APRIL

	$sql_sent_april = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		send_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'April' AND SSN = $ssn";
	$execute_sent_april = $dbConnected->query($sql_sent_april);

	if($execute_sent_april){
		$rows = $execute_sent_april->fetch_assoc();
		$max_sent_april = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_sent_april)){
		$max_sent_april = "No Entry For This Month";
	}else{
		$max_sent_april = "$".$max_sent_april;
	}

	// SELECT MAX AMOUNT SENT FOR MAY

	$sql_sent_may = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		send_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'May' AND SSN = $ssn";
	$execute_sent_may = $dbConnected->query($sql_sent_may);

	if($execute_sent_may){
		$rows = $execute_sent_may->fetch_assoc();
		$max_sent_may = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_sent_may)){
		$max_sent_may = "No Entry For This Month";
	}else{
		$max_sent_may = "$".$max_sent_may;
	}


	// SELECT MAX AMOUNT REQUESTED FOR JANUARY

	$sql_request_jan = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		request_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'January' AND SSN = $ssn";
	$execute_request_jan = $dbConnected->query($sql_request_jan);

	if($execute_request_jan){
		$rows = $execute_request_jan->fetch_assoc();
		$max_request_jan = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_request_jan)){
		$max_request_jan = "No Entry For This Month";
	}else{
		$max_request_jan = "$".$max_request_jan;
	}

	// SELECT MAX AMOUNT REQUESTED FOR FEBRUARY

	$sql_request_feb = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		request_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'February' AND SSN = $ssn";
	$execute_request_feb = $dbConnected->query($sql_request_feb);

	if($execute_request_feb){
		$rows = $execute_request_feb->fetch_assoc();
		$max_request_feb = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_request_feb)){
		$max_request_feb = "No Entry For This Month";
	}else{
		$max_request_feb = "$".$max_request_feb;
	}

	// SELECT MAX AMOUNT REQUESTED FOR MARCH

	$sql_request_march = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		request_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'March' AND SSN = $ssn";
	$execute_request_march = $dbConnected->query($sql_request_march);

	if($execute_request_march){
		$rows = $execute_request_march->fetch_assoc();
		$max_request_march = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_request_march)){
		$max_request_march = "No Entry For This Month";
	}else{
		$max_request_march = "$".$max_request_march;
	}

	// SELECT MAX AMOUNT REQUESTED FOR APRIL

	$sql_request_april = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		request_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'April' AND SSN = $ssn";
	$execute_request_april = $dbConnected->query($sql_request_april);

	if($execute_request_april){
		$rows = $execute_request_april->fetch_assoc();
		$max_request_april = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_request_april)){
		$max_request_april = "No Entry For This Month";
	}else{
		$max_request_april = "$".$max_request_april;
	}

	// SELECT MAX AMOUNT REQUESTED FOR MAY

	$sql_request_may = "SELECT MAX(AMOUNT) AS MAX_VAL
									 FROM		request_transaction
									 WHERE 	MONTHNAME(DATE_TIME) = 'May' AND SSN = $ssn";
	$execute_request_may = $dbConnected->query($sql_request_may);

	if($execute_request_may){
		$rows = $execute_request_may->fetch_assoc();
		$max_request_may = $rows['MAX_VAL'];
	}else{
		$dbConnected->error;
	}

	if(empty($max_request_may)){
		$max_request_may = "No Entry For This Month";
	}else{
		$max_request_may = "$".$max_request_may;
	}


}
?>


<html>
	<body>


<!-- Back Button -->



<p></p>
<p></p>
<!-- BY DATES -->
<div>
<a href = 'bydates.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button type="submit" style="width: 10%; height: 5%;"> BY DATES </button>
</a>
</div>

<p></p>

<!-- BY MONTH -->
<div>
<a href = 'bymonth.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button type="submit" style="width: 10%; height: 5%;"> BY MONTH </button>
</a>
</div>


<p></p>

<!-- The amount we received -->
<div>

  <u> <p>BEST USER:</p> </u>
<label>SENT:</label> <label> </label> <input type = "text" value = "<?php echo $best_sent_name?>" readonly="readonly" />
<label>REQUESTED:</label> <label> </label> <input type = "text"  value = "<?php echo $best_received_name?>" readonly="readonly" />

</div>



  <!-- Sign Out Form   -->
  <!-- change the 'file:/// link to whereever you keep the files. keep them all in one location, prerebaly in a WALLET folder on desktop' -->
<div>
<a href = 'login.html'>

<button  type="submit"  style="float:right"> Sign Out </button> </a>
</div>


<p></p> <!-- Adds space-->

<!-- Create Table for MAX -->
<p>MAX AMOUNT SENT PER MONTH</p>
<table style="width:50%" align="center">

<!-- Table Headers -->
<tr>
    <th>Month</th>
    <th>Amount</th>
</tr>

<!-- Data Examples-->
<tr>
    <td>January</td>
    <td><?php echo $max_sent_jan ?></td>
</tr>

<tr>
    <td>February</td>
    <td><?php echo $max_sent_feb ?></td>
</tr>

<tr>
    <td>March</td>
    <td><?php echo $max_sent_march ?></td>
</tr>

<tr>
    <td>April</td>
    <td><?php echo $max_sent_april ?></td>
</tr>

<tr>
    <td>May</td>
    <td><?php echo $max_sent_may ?></td>
</tr>

<!--

Extra data for the table if needed !
<tr>
    <td>June</td>
    <td>$$</td>
</tr>

<tr>
    <td>July</td>
    <td>$$</td>
</tr>
<tr>
    <td>August</td>
    <td>$$</td>
</tr>

<tr>
    <td>September</td>
    <td>$$</td>
</tr>

<tr>
    <td>October</td>
    <td>$$</td>
</tr>

<tr>
    <td>November</td>
    <td>$$</td>
</tr>

<tr>
    <td>December</td>
    <td>$$</td>
</tr>

-->
</table>

<p>MAX AMOUNT REQUESTED PER MONTH</p>
<table style="width:50%" align="center">

<!-- Table Headers -->
<tr>
    <th>Month</th>
    <th>Amount</th>
</tr>

<!-- Data Examples-->
<tr>
    <td>January</td>
    <td><?php echo $max_request_jan ?></td>
</tr>

<tr>
    <td>February</td>
    <td><?php echo $max_request_feb ?></td>
</tr>

<tr>
    <td>March</td>
    <td><?php echo $max_request_march ?></td>
</tr>

<tr>
    <td>April</td>
    <td><?php echo $max_request_april ?></td>
</tr>

<tr>
    <td>May</td>
    <td><?php echo $max_request_may ?></td>
</tr>

<!--

Extra data for the table if needed !
<tr>
    <td>June</td>
    <td>$$</td>
</tr>

<tr>
    <td>July</td>
    <td>$$</td>
</tr>
<tr>
    <td>August</td>
    <td>$$</td>
</tr>

<tr>
    <td>September</td>
    <td>$$</td>
</tr>

<tr>
    <td>October</td>
    <td>$$</td>
</tr>

<tr>
    <td>November</td>
    <td>$$</td>
</tr>

<tr>
    <td>December</td>
    <td>$$</td>
</tr>

-->
</table>

	</body>

</html>
</br>
