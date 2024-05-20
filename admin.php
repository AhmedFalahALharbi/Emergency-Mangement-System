<?php
include 'inc/connection.php';
$conn = mysqli_connect($servername, $user, $password, $dbname);
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM incident";
$result = $conn->query($sql);

$sqlProfiles = "";
if (isset($_POST['showProfiles'])) {
    $sqlProfiles = "SELECT username,Full_Name, Person_ID, numberOfReports FROM userProfile";
    $resultProfiles = $conn->query($sqlProfiles);
} else {
}
include 'inc/db_close.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="JannaLTRegular.css">

</head>

<body class="admin">
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
            <img src="images/logo.png" alt="Logo">
            <h2>Emergency Management System</h2>
        </div>
        <h1>Admin Page</h1>

        <h2>Incidents</h2>
        <table>
            <tr>
                <th>Incident_No</th>
                <th>Person_ID</th>
                <th>Emergency_Level</th>
                <th>Reporter_Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Date_Created</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['Incident_No']; ?></td>
                    <td><?php echo "" . $row['Person_ID']; ?></td>
                    <td><?php echo $row['Emergency_Level']; ?></td>
                    <td><?php echo $row['Reporter_Name']; ?></td>
                    <td><?php echo $row['Description_']; ?></td>
                    <td><?php echo $row['Location_']; ?></td>
                    <td><?php echo $row['Date_Created']; ?></td>
                </tr>
            <?php } ?>
        </table>

        <br>

        <h2>User Profiles</h2>
        <form method="POST">
            <button type="submit" name="showProfiles">Show Profiles</button>
        </form>

        <?php if (isset($_POST['showProfiles'])) { ?>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Full_Name</th>
                    <th>Person_ID</th>
                    <th>Number of Reports</th>
                </tr>
                <?php while ($rowProfiles = $resultProfiles->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowProfiles['username']; ?></td>
                        <td><?php echo $rowProfiles['Full_Name']; ?></td>
                        <td><?php echo $rowProfiles['Person_ID']; ?></td>
                        <td><?php echo $rowProfiles['numberOfReports']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

        <br>

        <div class="links-container">
            <a href="index.php">Home</a>
            <a href="report.php">Go to Report Page</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>