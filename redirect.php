<?php
session_start();
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$db= mysqli_connect($host, $user, $pass, $dbname);

$cus0 = "SELECT MAX(cusID) FROM Cuser";
$cus1 = mysqli_query($db, $cus0 ) or die ("Error: " .mysqli_error($db));
$cus2 = mysqli_fetch_array($cus1, MYSQLI_NUM);
    $query2 = "SELECT empType FROM Cuser where cusID='$cus2[0]'";
    $row=mysqli_query($db, $query2);
    $row1= mysqli_fetch_assoc($row);
    $_SESSION['empType'] = $row1['empType'];

if ($row1['empType'] != null) {
    if($row1['empType']=='admin'){
    header('location:http://localhost/read2rent/staff.php'); 
    }else {
        header('location:http://localhost/read2rent/staffs.php'); 
    }
}  else {
    header('location:http://localhost/read2rent/users.php'); 
}
?>