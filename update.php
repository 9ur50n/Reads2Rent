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
    $ID = mysqli_real_escape_string($db, $_POST['ID']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $genre = mysqli_real_escape_string($db, $_POST['genre']);
    $image_name = $_FILES['file']['name'];
    $temp_name = $_FILES["file"]["tmp_name"];

    if (!empty($title)) {
        $query1 = "UPDATE `book` SET `bookName`='$title' where `bookID`='$ID'";
        $results0 = mysqli_query($db, $query1) or die ("Error: " .mysqli_error($db));
    }
    if (!empty($author)) {
        $query2 = "UPDATE `book` SET `bookAuthor`='$author' where `bookID`='$ID'";
        $results1 = mysqli_query($db, $query2) or die ("Error: " .mysqli_error($db));
    }
    if (!empty($genre)) {
        $query3 = "UPDATE `book` SET `bookGenre`='$genre' where `bookID`='$ID'";
        $results2 = mysqli_query($db, $query3) or die ("Error: " .mysqli_error($db));
    }
    if(!empty($_FILES['fileToUpload']['name'])) {
        $query4 = "UPDATE `book` SET `bookImageLocation`='$image_name' where `bookID`='$ID'";
        $results3 = mysqli_query($db, $query4) or die ("Error: " .mysqli_error($db));
        $target_dir = "read2rent/image/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    }
}
mysqli_close($db);
?>