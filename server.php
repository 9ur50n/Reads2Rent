<?php 
session_start();

//database connection
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$errors = array(); 
$db= mysqli_connect($host, $user, $pass, $dbname);


      $query6 = "DELETE FROM Cuser";
      $results5 = mysqli_query($db, $query6) or die ("Error: " .mysqli_error($db));

$message;
function error_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 

if (mysqli_connect_errno()) 
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

//register form
if (isset($_POST['reg_user'])) 
{
  
    // Receiving the values entered and storing
    // in the variables
    // Data sanitization is done to prevent
    // SQL injections
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
	$adress = mysqli_real_escape_string($db,$_POST['adress']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $_SESSION['username'] = $username;

    $getID = "SELECT usID FROM users WHERE usUsername='$username'";
    $resultID = mysqli_query($db, $getID) or die ("Error: " .mysqli_error($db));
    $usID1 = mysqli_fetch_array($resultID, MYSQLI_NUM);
  
    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($adress)) { array_push($errors, "Adress is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
  
    $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
  
    if (!preg_match($pattern, $password_1)) { 
        $textAlert = "Password has not fullfill the requirement. it must contain min 1 uppercase and 1 undercase letter, a min of 1 digit and min 1 special character and it must also contain min 8 character";
        error_alert($errors[] = ($textAlert));
        echo '<script>';
        echo 'window.location.href="http://localhost/read2rent/register.php"'; //Redirects the user with JavaScript
        echo '</script>';
        die();

    } 
    if ($password_1 != $password_2) {
        error_alert($errors[] = "The two passwords do not match"); 
        echo '<script>';
        echo 'window.location.href="http://localhost/read2rent/register.php"'; //Redirects the user with JavaScript
        echo '</script>';
        die();
        // Checking if the passwords match
    }
	$sql0 = "SELECT usUsername FROM users WHERE usUsername= '$username'";
    $query0 = mysqli_query($db, $sql0) or die ("Error: " .mysqli_error($db));
	$row0 = mysqli_num_rows($query0);
    $sql1 = "SELECT usEmail FROM users WHERE usEmail= '$email'";
    $query1 = mysqli_query($db, $sql1) or die ("Error: " .mysqli_error($db));
	$row1 = mysqli_num_rows($query1);
    if($row1 != 0)
    {
        error_alert($errors[] = "the email has been registered by different user");
        echo '<script>';
        echo 'window.location.href="http://localhost/read2rent/register.php"'; //Redirects the user with JavaScript
        echo '</script>';
        die();

    }else
    if($row0 != 0)
    {
        
        error_alert($errors[] = "the username has been registered by different user");
        echo '<script>';
        echo 'window.location.href="http://localhost/read2rent/register.php"'; //Redirects the user with JavaScript
        echo '</script>';
        die();

    }

	// If the form is error free, then register the user
    if (count($errors) == 0) {
         
        // Password encryption to increase data security
        $password = md5($password_1);
         
        // Inserting data into table
        $query = "INSERT INTO users (usUsername,usAdress, usEmail, usPassword) 
                  VALUES('$username', '$adress','$email', '$password')"; 
         
        mysqli_query($db, $query);

        $query2 = "INSERT INTO Cuser (usID,username) 
        VALUES('$usID1[0]', '$username')"; 

        mysqli_query($db, $query2);
        // Storing username of the logged in user,
        // in the session variable

         
        // Page on which the user will be 
        // redirected after logging in
        header('location:http://localhost/read2rent/dashboard.php'); 
        exit();
    }       
}

// User login
if (isset($_POST['login_user'])) 
{
     
    // Data sanitization to prevent SQL injection
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $_SESSION['username'] = $username;
    
    $getID = "SELECT usID FROM users WHERE usUsername='$username'";
    $resultID = mysqli_query($db, $getID) or die ("Error: " .mysqli_error($db));
    $usID1 = mysqli_fetch_array($resultID, MYSQLI_NUM);
    // Error message if the input field is left blank
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Checking for the errors
    if (count($errors) == 0) {
         
        // Password matching
        $password = md5($password);
         
        $query = "SELECT * FROM users WHERE usUsername=
                '$username' AND usPassword='$password'";
        $results = mysqli_query($db, $query) or die ("Error: " .mysqli_error($db));
        
        // $results = 1 means that one user with the
        // entered username exists
        if (mysqli_num_rows($results) == 1) {
             
            $checker0 ="SELECT empType from employee where usID='$usID1[0]'";
            $checker = mysqli_query($db, $checker0) or die ("Error: " .mysqli_error($db));
            $row3 = mysqli_num_rows($checker);
            if($row3 != 0)
            {

               

            $checker1= mysqli_fetch_object($checker);
            $_SESSION['empType'] = $checkf;
              $query2 = "INSERT INTO Cuser (usID,username,empType) 
              VALUES('$usID1[0]', '$username','$checker1->empType')"; 
               mysqli_query($db, $query2);
                header('location:http://localhost/read2rent/dashboard.php'); 
                exit();
        
            }

            // Storing username in session variable
            
             
            // Page on which the user is sent
            // to after logging in
            $query2 = "INSERT INTO Cuser (usID,username) VALUES('$usID1[0]', '$username')"; 
    
            mysqli_query($db, $query2);
            header('location:http://localhost/read2rent/dashboard.php'); 
            exit();
        }
        else {
             
            // If the username and password doesn't match
            array_push($errors, "Username or password incorrect"); 
        }
    }
}

?>
