<?php
session_start();
include("../base.php");
$id = $_SESSION['ID'];
$pwd = $_SESSION['Password'];
$result = displayDetails($id);
?>

<html>

<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../styles/profile.css" />
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <script>
        function alert_f() {
            alert('Confirm Form Submission!');
        }
    </script>
</head>

<body style="background-image: url('../media/online.png')">
    <div id="buttons">
        <h2>Options</h2>
        <div id="buttonBox">
            <form method="session" action="../app/app.php">
                <input type="submit" value="Dashboard" name="dash" id="buttonOption" />
            </form>
            <form method="post">
                <input type="submit" value="Edit Profile" name="edit" id="buttonOption"
                    formaction="../app/editProfile.php" />
            </form>
            <form action="../controller/logoutControl.php" method="post">
                <input type="submit" value="Logout" id="buttonOption" name="Logout" onclick="alert_f()" />
            </form>
        </div>
        <?php
        if (array_key_exists("dash", $_SESSION)) {
            loginUser($id, $pwd);
        }
        ?>
    </div>
    <div id="displayProfile">
        <h1>Customer Profile</h1>
        <?php
        echo "<div id='details'>";
        echo "<h3>Name: " . $result['Name'] . "<br>
                Date of Birth: " . $result['Date_of_Birth'] . "<br>
                Address Line 1: " . $result['Address1'] . "<br>
                Address Line 2 (optional): " . $result['Address2'] . "<br>
                Phone Number: " . $result['Phone'] . "<br>
                Customer ID: " . $result['CustomerID'] . "</h3>";
        echo "</div>";
        ?>
    </div>
</body>

</html>