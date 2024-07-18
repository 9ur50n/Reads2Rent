<?php
session_start();
$key = $_SESSION['username'];
if(!isset($_SESSION['username'])){
    $user = "root";
   $pass = ""; 
   $host = "localhost";
   $dbname= "read2rent";
   $db= mysqli_connect($host, $user, $pass, $dbname);
    $query2 = 'SELECT username,empType FROM Cuser where (Select max(cusID) from Cuser)';
    $row=mysqli_query($db, $query2);
    $row1= mysqli_fetch_assoc($row);
    $_SESSION['username'] = $row1['username'];
    $_SESSION['empType'] = $row1['empType'];
    $key =  $row1['username'];
  }
$host = 'localhost';
$dbname = 'read2rent';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

function getReceipt($pdo,$key){
    $stmt = $pdo->prepare
("
        SELECT * from detail where transID in 
            (	select transID from buyrent where usID=(select usID from users where usUsername= :us and status='Approve') )");
    $stmt->execute(['us' => $key]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$receipt = getreceipt( $pdo, $key);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Staff Dashboard</title>
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
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="printpdf.php">print latest receipt</a>
        </li>
    </ul>
</nav>
<nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="users.php">
                            <i class="zmdi zmdi-widgets"></i>
                            User Dashboard 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="zmdi zmdi-file-text"></i>
                            print receipt 
                        </a>
                    </li>
                </ul>
            </div>
</nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
            <div class="projects mb-4">
                <div class="projects-inner">
                    <header class="projects-header">
                        <div class="title">receipt</div>
                    </header>
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>receipt ID</th>
                                <th>purchace date</th>
                                <th>book ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($receipt as $detail): ?>
                                <tr>
                                    <td>
                                        <p><?php echo htmlspecialchars($detail['deID']); ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo htmlspecialchars($detail['deDate']); ?></p>
                                    </td>
                                    <td>
                                        <p><?php echo htmlspecialchars($detail['bookID']); ?></p>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
            </div>
    </main>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src='https://cdn.jsdelivr.net/jquery.selectric/1.10.1/jquery.selectric.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js'></script>
<script src="./script.js"></script>
<script>
    // Add this script to prevent form resubmission on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>