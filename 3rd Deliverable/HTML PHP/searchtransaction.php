<html>

  <head>
  <div class="back">
    <a href = 'mainpage_new.php?ssn=<?php echo "".$ssn = $_GET['ssn'] ?>'>
<button  type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Back To Previous Page </button> </a>
</div>
  <!-- This is the header code-->
<div class="row justify-content-center container-auto"
style="paddingBottom: 100">
<u> <font color = "blue" size = 5px> <h2 class="center-block">Search</h2> </font> </u>
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

  $sql_ssn_sent = "SELECT Stid, Amount, DATE_TIME, Memo, Cancel_Reason, Identifier
                   FROM   send_transaction
                   WHERE  SSN = '$ssn'";
  $sql_ssn_req = "SELECT  Rtid, Amount, DATE_TIME, Memo
                  FROM    request_transaction
                  WHERE   SSN='$ssn'";

  $execute_sent_ssn = $dbConnected->query($sql_ssn_sent);
  $execute_req_ssn = $dbConnected->query($sql_ssn_req);

  if($execute_sent_ssn){
    echo "<br>";
    echo "<table  style='width:40%' align='centre'>";
    echo "<td>Stid</td><td>Amount</td><td>Date And Time</td><td>Memo</td><td>Cancel Reason</td><td>Contact Info</td>";
    while($row = $execute_sent_ssn->fetch_assoc()){
        echo "<tr>";
        foreach ($row as $value) {
          echo "<td>".$value."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
  }else{
    $dbConnected->error;
  }

  if($execute_req_ssn){
    echo "<br>";
    echo "<table style='width:40%' align='centre'>";
    echo "<td>Rtid</td><td>Amount</td><td>Date And Time</td><td>Memo</td>";
    while($row = $execute_req_ssn->fetch_assoc()){
        echo "<tr>";
        foreach ($row as $value) {
          echo "<td>".$value."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
  }else{
    $dbConnected->error;
  }

  if(isset($_POST['email'])){

      echo "<br><br>";

      $email = $_POST['email'];

      $sql_send = "SELECT Stid, Amount, DATE_TIME, Memo, Cancel_Reason, Identifier
                   FROM   send_transaction
                   WHERE  SSN='$ssn' AND Identifier = '$email'";

      $sql_req = "SELECT  Rtid, Amount, DATE_TIME, Memo
                  FROM    request_transaction
                  WHERE   SSN='$ssn' AND Rtid IN (SELECT  Rtid
                                                  FROM    from_table
                                                  WHERE   Identifier='$email')";

      $result_sent = $dbConnected->query($sql_send);
      $result_req = $dbConnected->query($sql_req);

      if($result_sent){
        echo "<br>";
        echo "<table  style='width:40%' align='centre'>";
        echo "<td>Stid</td><td>Amount</td><td>Date And Time</td><td>Memo</td><td>Cancel Reason</td><td>Contact Info</td>";
        while($row = $result_sent->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

      if($result_req){
        echo "<br>";
        echo "<table style='width:40%' align='centre'>";
        echo "<td>Rtid</td><td>Amount</td><td>Date And Time</td><td>Memo</td>";
        while($row = $result_req->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

  }


  if(isset($_POST['phoneNo'])){

      echo "<br><br>";

      $phoneNo = $_POST['phoneNo'];

      $sql_send = "SELECT Stid, Amount, DATE_TIME, Memo, Cancel_Reason, Identifier
                   FROM   send_transaction
                   WHERE  SSN='$ssn' AND Identifier = '$phoneNo'";

      $sql_req = "SELECT  Rtid, Amount, DATE_TIME, Memo
                  FROM    request_transaction
                  WHERE   SSN='$ssn' AND Rtid IN (SELECT  Rtid
                                                  FROM    from_table
                                                  WHERE   Identifier='$phoneNo')";

      $result_sent = $dbConnected->query($sql_send);
      $result_req = $dbConnected->query($sql_req);

      if($result_sent){
        echo "<br>";
        echo "<table  style='width:40%' align='centre'>";
        echo "<td>Stid</td><td>Amount</td><td>Date And Time</td><td>Memo</td><td>Cancel Reason</td><td>Contact Info</td>";
        while($row = $result_sent->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

      if($result_req){
        echo "<br>";
        echo "<table style='width:40%' align='centre'>";
        echo "<td>Rtid</td><td>Amount</td><td>Date And Time</td><td>Memo</td>";
        while($row = $result_req->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

  }


  if(isset($_POST['date'])){

      echo "<br><br>";

      $date = $_POST['date'];

      $sql_send = "SELECT Stid, Amount, DATE_TIME, Memo, Cancel_Reason, Identifier
                   FROM   send_transaction
                   WHERE  DATE(DATE_TIME) = '$date' AND SSN='$ssn'";

      $sql_req = "SELECT  Rtid, Amount, DATE_TIME, Memo
                  FROM    request_transaction
                  WHERE   DATE(DATE_TIME) = '$date' AND SSN='$ssn'";

      $result_sent = $dbConnected->query($sql_send);
      $result_req = $dbConnected->query($sql_req);

      if($result_sent){
        echo "<br>";
        echo "<table  style='width:40%' align='centre'>";
        echo "<td>Stid</td><td>Amount</td><td>Date And Time</td><td>Memo</td><td>Cancel Reason</td><td>Contact Info</td>";
        while($row = $result_sent->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

      if($result_req){
        echo "<br>";
        echo "<table style='width:40%' align='centre'>";
        echo "<td>Rtid</td><td>Amount</td><td>Date And Time</td><td>Memo</td>";
        while($row = $result_req->fetch_assoc()){
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>".$value."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
      }else{
        $dbConnected->error;
      }

  }



}

?>

<html>
  <body>

<!-- Back Button -->



<p> </p>

<!-- The user's email and amount who we are sending the money -->

<p> </p>

<form action="#" method="POST">
<label> Email ID </label>
<input type="email" name="email" placeholder="Enter the Email_Id"/>
<button style="width: 10%; height: 5%;" type="submit"> Proceed </button>
</form>

<p> </p>

<form action="#" method="POST">
<label> PhoneNo </label>
<input type="tel" name="phoneNo" placeholder="Enter the Phone #"/>
<button style="width: 10%; height: 5%;" type="submit"> Proceed </button>
</form>

<p> </p>
<form action="#" method="POST">
<label> Date </label>
<input type="date" id="start" name="date" value="2020-01-01" min="2020-01-01" max="2020-12-31">
</input><button style="width: 10%; height: 5%;" type="submit"> Proceed </button>
</form>

<p> </p>


<!-- Sign Out Form   -->
  <!-- change the text after 'file:///' to where-ever you keep the files. keep them all in one location, prerebaly in a WALLET folder on desktop' -->

<div class="sign-out">
<a href = 'login.html'>
<button type="submit"   class= "btn btn-primary"  name="sign-out" style="float:right"> Sign Out </button> </a>
</div>

  </body>
</html>
