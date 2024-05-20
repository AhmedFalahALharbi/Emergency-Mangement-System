<?php
include 'inc/connection.php';
$conn = mysqli_connect($servername, $user, $password, $dbname);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM userprofile WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['Password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['username'] = $username;
            if ($username === 'admin') {
                header('Location: admin.php');
                exit;
            }
            header('Location: report.php');
            exit;
        } else {
            $error = 'Wrong password';
        }
    } else {
        $error = 'Wrong username';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    session_destroy();
    header('Location: register.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guest'])) {
    session_destroy();
    $_SESSION['username'] = 'Guest';
    header('Location: report.php');
    exit;
}
include 'inc/db_close.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="JannaLTRegular.css">
    <style>
        body.login {
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

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form.center-form button {
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="login">
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
            <img src="images/logo.png" alt="Logo">
            <h2>Emergency Management System</h2>
        </div>
        <h1>Login Page</h1>

        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>

        <div class="form-container">
            <form method="POST" action="" class="center-form">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" required><br>

                <button type="submit">Login</button>
            </form>

            <form method="POST" action="">
                <input type="hidden" name="guest" value="guest">
                <button type="submit">Login as a Guest</button>
            </form>
        </div>

        <div class="links-container">
            <a href="register.php">Register</a>
            <a href="report.php">Report</a>
        </div>

        <div class="links-container">
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>
