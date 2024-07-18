<?php
session_start();


date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date('y/m/d');
//database connection
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$db= mysqli_connect($host, $user, $pass, $dbname);

if(!isset($_SESSION['username'])){

    $cus0 = "SELECT MAX(cusID) FROM Cuser";
    $cus1 = mysqli_query($db, $cus0 ) or die ("Error: " .mysqli_error($db));
    $cus2 = mysqli_fetch_array($cus1, MYSQLI_NUM);
    $query2 = "SELECT username,empType FROM Cuser where cusID='$cus2[0]'";
    $row=mysqli_query($db, $query2);
    $row1= mysqli_fetch_assoc($row);
    $_SESSION['username'] = $row1['username'];
    $_SESSION['empType'] = $row1['empType'];
    }

if (isset($_POST['buybook'])) 
{

    $user=$_SESSION['username'];
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    if (empty($title)) {
        array_push($errors, "title is required");
        exit();
    }
    
    $query = "SELECT bookID FROM book WHERE bookName='$title'";
    $results = mysqli_query($db, $query) or die ("Error: " .mysqli_error($db));
    $row = mysqli_fetch_array($results, MYSQLI_NUM);

    $query1 = "INSERT INTO `payment`( `payAmount`) VALUES ('25')";
    $results0 = mysqli_query($db, $query1) or die ("Error: " .mysqli_error($db));

    $lastestpay0 = "SELECT MAX(payID) FROM payment";
    $lastestpay = mysqli_query($db, $lastestpay0 ) or die ("Error: " .mysqli_error($db));
    $rowpay = mysqli_fetch_array($lastestpay, MYSQLI_NUM);

    $query2 = "SELECT usID FROM users WHERE usUsername='$user'";
    $results1 = mysqli_query($db, $query2) or die ("Error: " .mysqli_error($db));
    $usID1 = mysqli_fetch_array($results1, MYSQLI_NUM);

    $query3 = "INSERT INTO `buyrent`( `usID`,`payID`,`transType`) values('$usID1[0]','$rowpay[0]','$type')";
    $results2 = mysqli_query($db, $query3) or die ("Error: " .mysqli_error($db));

    $lastestTransaction0 = "SELECT MAX(transID) FROM buyrent";
    $transaction = mysqli_query($db, $lastestTransaction0 ) or die ("Error: " .mysqli_error($db));
    $transaction0 = mysqli_fetch_array($transaction, MYSQLI_NUM);

    $query6 = "INSERT INTO `detail`( `transID` ,`bookID`,`deDate`) values('$transaction0[0]','$row[0]','$date')";
    $results5 = mysqli_query($db, $query6) or die ("Error: " .mysqli_error($db));
    header('location:http://localhost/read2rent/payment.html');


}
mysqli_close($db);
?>