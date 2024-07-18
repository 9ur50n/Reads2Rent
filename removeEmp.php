<?php
session_start();

//database connection
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$db= mysqli_connect($host, $user, $pass, $dbname);


if (isset($_POST['submit'])) 
{
    $empID = mysqli_real_escape_string($db, $_POST['empID']);
    $query = "DELETE FROM `employee` WHERE empID='$empID'";
    $results = mysqli_query($db, $query) or die ("Error: " .mysqli_error($db));
    header('location:http://localhost/read2rent/empRegister.php');
}
mysqli_close($db);
?>