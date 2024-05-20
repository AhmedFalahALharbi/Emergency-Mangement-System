<?php
include 'inc/connection.php';
$conn = mysqli_connect($servername, $user, $password, $dbname);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ID = $_POST['ID'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthDate = $_POST['birthDate'];
    $address = $_POST['address'];
    $phoneNumbers = $_POST['phone_numbers'];
    $personRole = $_POST['personRole'];
    $college = '';
    $professionName = '';
    $pSend = $_POST['register'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($personRole === 'student') {
        $college = $_POST['college'];
    } elseif ($personRole === 'employee') {
        $professionName = $_POST['professionName'];
    }

    $sql = "SELECT username FROM userprofile WHERE username = '$username'";
    $result = $conn->query($sql);
    if ($pSend) {
        if ($result->num_rows > 0) {
            $error = 'Invalid username or password';
            header('Location: register.php');
            exit;
        } else {
            $phoneNumberString = implode(',', $phoneNumbers);
            $fullName = $fname . ' ' . $mname . ' ' . $lname;

            $query1 = "INSERT INTO person(ID, fname, mname, lname, Birth_date, Address_, Person_Role, Profession_Name, College)
            VALUES ('$ID', '$fname', '$mname', '$lname', '$birthDate', '$address', '$personRole', '$professionName', '$college')";
            $query2 = "INSERT INTO userprofile(username, Password,Person_ID, Full_Name, numberOfReports) 
            VALUES ('$username','$hashedPassword','$ID','$fullName',0)";
            $query3 = "INSERT INTO person_phone_number(Person_ID, Phone_Number) VALUES ('$ID', '$phoneNumberString')";

            $result1 = mysqli_query($conn, $query1);
            $result2 = mysqli_query($conn, $query2);
            $result3 = mysqli_query($conn, $query3);
        }
    }
    $_SESSION['username'] = $username;
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
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="JannaLTRegular.css">
</head>

<body class="register">
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
        <h1>Registration Page</h1>

        <?php if (isset($error)) { ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php } ?>

        <div class="form-container">
            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" name="password" required><br>

                <label for="ID">ID:</label>
                <input type="text" name="ID" required><br>

                <label for="fname">First Name:</label>
                <input type="text" name="fname" required><br>

                <label for="mname">Middle Name:</label>
                <input type="text" name="mname" required><br>

                <label for="lname">Last Name:</label>
                <input type="text" name="lname" required><br>

                <label for="birthDate">Birth Date:</label>
                <input type="date" name="birthDate" required><br>

                <label for="address">Address:</label>
                <input type="text" name="address" required><br>

                <label for="phone_numbers">Phone Numbers:</label>
                <div id="phoneNumbersContainer">
                    <input type="text" name="phone_numbers[]" required>
                </div>
                <button type="button" onclick="addPhoneNumberField()">Add Phone Number</button><br>

                <label for="personRole">Person Role:</label>
                <select name="personRole">
                    <option value="Choose Role">Choose</option>
                    <option value="student">Student</option>
                    <option value="employee">Employee</option>
                </select><br>

                <div id="collegeField" style="display: none;">
                    <label for="college">College:</label>
                    <input type="text" name="college"><br>
                </div>

                <div id="professionField" style="display: none;">
                    <label for="professionName">Profession Name:</label>
                    <input type="text" name="professionName"><br>
                </div>

                <script>
                    function addPhoneNumberField() {
                        var phoneNumbersContainer = document.getElementById('phoneNumbersContainer');
                        var phoneNumberInput = document.createElement('input');
                        phoneNumberInput.type = 'text';
                        phoneNumberInput.name = 'phone_numbers[]';
                        phoneNumberInput.required = true;
                        phoneNumbersContainer.appendChild(phoneNumberInput);
                    }

                    document.querySelector('select[name="personRole"]').addEventListener('change', function() {
                        var collegeField = document.getElementById('collegeField');
                        var professionField = document.getElementById('professionField');

                        if (this.value === 'student') {
                            collegeField.style.display = 'block';
                            professionField.style.display = 'none';
                        } else if (this.value === 'employee') {
                            collegeField.style.display = 'none';
                            professionField.style.display = 'block';
                        } else {
                            collegeField.style.display = 'none';
                            professionField.style.display = 'none';
                        }
                    });
                </script>

                <input type="hidden" name="register" value="register">
                <input type="submit" value="Register" style="display: block; margin: 0 auto; color: green; font-size: 1.2em;">

                <!-- <input type="hidden" name="register" value="register">
                <input type="submit" value="Register"> -->
            </form>
        </div>

        <div class="links-container">
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>

</html>