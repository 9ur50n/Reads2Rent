<?php
session_start();
// Database connection
$user = "root";
$pass = ""; 
$host = "localhost";
$dbname= "read2rent";
$password = '';
$db= mysqli_connect($host, $user, $pass, $dbname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>update book - Reads2Rent</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/jquery.selectric/1.10.1/selectric.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="staff.css">
</head>
<body>
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Reads2Rent</a>

    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="staff.php">
                                <i class="zmdi zmdi-widgets"></i>
                                Staff Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="staffOrders.php">
                                <i class="zmdi zmdi-file-text"></i>
                              Orders  
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addbook.php">
                                <i class="zmdi zmdi-widgets"></i>
                                Add Book 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="updatebook.php#">
                                <i class="zmdi zmdi-widgets"></i>
                                update Book 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="empRegister.php#">
                                <i class="zmdi zmdi-widgets"></i>
                                Manage Staff <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="deleteBook.php">
                                <i class="zmdi zmdi-delete"></i>
                                Delete Book 
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
                <div class="projects mb-4">
                    <div class="projects-inner">
                        <header class="projects-header">
                            <div class="title">Employee Register</div>
                        </header>
                        <form  method="post" action="addEmp.php">   
                            <input type="text" class="form-control" name="usID" placeholder="user ID" required="" autofocus="" />
                            <input type="text" class="form-control" name="empType" placeholder="Access Level"required="" autofocus="" />
                                <input class="btn btn-lg btn-primary btn-block" value="Add Staff" name="submit" type="submit">
                        </form>
                    </div>
                </div>


                <div class="projects mb-4">
                    <div class="projects-inner">
                        <header class="projects-header">
                            <div class="title">Remove Employee</div>
                        </header>
                        <form  method="post" action="removeEmp.php">   
                            <input type="text" class="form-control" name="empID" placeholder="Employee ID" required="" autofocus="" />
                                <input class="btn btn-lg btn-primary btn-block" value="Remove staff" name="submit" type="submit">
                        </form>
                    </div>
                </div>

        </div>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
    <script src='https://cdn.jsdelivr.net/jquery.selectric/1.10.1/jquery.selectric.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js'></script>
    <script src="./script.js"></script>
</body>
</html>
