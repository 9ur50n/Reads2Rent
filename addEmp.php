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
    $usID = mysqli_real_escape_string($db, $_POST['usID']);
    $empType = mysqli_real_escape_string($db, $_POST['empType']);

    $query = "INSERT INTO employee(`usID`,`empType`) VALUES('$usID','$empType')";
    $results = mysqli_query($db, $query) or die ("Error: " .mysqli_error($db));

    header('location:http://localhost/read2rent/empRegister.php');
}
mysqli_close($db);
?>