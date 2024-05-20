<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="JannaLTRegular.css">
    <style>
        body.index {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('images/Hospital.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="index">
    <header>
        <div class="top-bar">
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo 'Welcome';
            }
            ?>
        </div>
    </header>
    <div class="main">
        <div class="logo">
            <img src="images/logo.png" alt="Logo" />
            <h2>Emergency Management System</h2>
        </div>
        <h3>About EMS</h3>
        <p class="website-description">This website is designed to manage emergencies and reporting. It allows users to submit incidents,
            provide information, and contribute to the overall safety and security of the university.</p>
        <p class="website-description">By utilizing this system, users can help authorities respond quickly to incidents,
            assess the level of emergency, and take appropriate actions to limit risks and ensure public safety.</p>

        <form method="POST" action="login.php" class="center-form">
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
