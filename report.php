<?php
include 'inc/connection.php';
$conn = mysqli_connect($servername, $user, $password, $dbname);
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $reporterName = ''; 

    $sql = "SELECT Full_Name FROM userprofile WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reporterName = $row['Full_Name'];
    }
} else {
    $reporterName = isset($_POST['reporter_Name']) ? $_POST['reporter_Name'] : '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numberOfR = 0;
    $description = $_POST['description_'];
    $location = $_POST['location_'];
    $emergencyLevel = $_POST['emergency_Level'];
    $dateCreated = date("Y-m-d");
    $pSend = $_POST['submit'];

    if ($pSend) {
            $sql = "SELECT Person_ID FROM userprofile WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $personID = $row['Person_ID'];
                $query = "INSERT INTO incident(reporter_Name,description_,location_,emergency_Level, Date_Created, Person_ID) value('$reporterName',
            '$description','$location','$emergencyLevel', '$dateCreated', '$personID')";
                $result = mysqli_query($conn, $query);

                $sqlprofile = "SELECT numberOfReports FROM userprofile WHERE username = '$username'";
                $resultprofile = $conn->query($sqlprofile);
                if ($resultprofile->num_rows > 0) {
                    $row = $resultprofile->fetch_assoc();
                    $numberOfR = $row['numberOfReports'] + 1;
                    $sqlupdate = "UPDATE userprofile SET numberOfReports = '$numberOfR' WHERE Person_ID = $personID";
                    $resultupdate = mysqli_query($conn, $sqlupdate);
                }
            }else {
            $query = "INSERT INTO incident(reporter_Name,description_,location_,emergency_Level, Date_Created) value('$reporterName','$description',
    '$location','$emergencyLevel', '$dateCreated')";
            $result = mysqli_query($conn, $query);
        }
    }
}
include 'inc/db_close.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Reporting</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="JannaLTRegular.css">
    
</head>

<body class="report">
    <header>
        <div class="top-bar">
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo '<span class="username">Welcome, ' . $username . '</span>';
            }
            ?>
        </div>
    </header>
    <div class="main">
        <div class="logo">
            <image src="images/logo.png" />
            <h2>Emergency Management System</h2>
        </div>
        <h1>Incident Reporting</h1>

        <form method="POST" action="">
            <label for="reporter_Name">Reporter Name:</label>
            <input type="text" name="reporter_Name" value="<?php echo $reporterName; ?>" <?php echo isset($_SESSION['username']) ? 'readonly' : ''; ?> required><br><br>

            <label for="description_">Description:</label><br>
            <textarea name="description_" rows="4" cols="30" required></textarea><br><br>

            <label for="location_">Location:</label>
            <input type="text" name="location_" required><br><br>

            <label for="emergencyLevel">Emergency Level:</label>
            <select name="emergency_Level">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>

        <br>

        <div class="links-container">
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>