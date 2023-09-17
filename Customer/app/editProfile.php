<?php
session_start();
include("../base.php");
$id = $_SESSION['ID'];
$name = $_GET['name'];
$name = strtoupper($name);
$dob = $_GET['dob'];
$pwd = $_GET['pass'];
$phn = $_GET['phone'];
$ar1 = $_GET['a1'];
$ar2 = $_GET['a2'];

function nameEdit()
{
    global $id, $name;
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
    $sql = "UPDATE customers SET Name='$name' WHERE customerid='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Name updated!";
    } else {
        echo "error";
    }
}

function dobEdit()
{
    global $id, $dob;
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
    $sql = "UPDATE customers SET Date_of_Birth='$dob' WHERE customerid='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Date of birth updated!";
    } else {
        echo "error";
    }
}

function phnEdit()
{
    global $id, $phn;
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
    $sql = "UPDATE customers SET Phone='$phn' WHERE customerid='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Phone number updated!";
    } else {
        echo "error";
    }
}

function addressEdit()
{
    global $id, $a1, $a2;
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
    $sql = "UPDATE customers SET Address1='$a1', Address2='$a2' WHERE customerid='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Address updated!";
    } else {
        echo "error";
    }
}

function pwdEdit()
{
    global $id, $pwd;
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
    $sql = "UPDATE customers SET Password='$pwd' WHERE customerid='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Password updated!";
    } else {
        echo "error";
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="../styles/register.css" />
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <script type="text/javascript">
        function alert_f() {
            alert('Confirm Form Submission!');
        }
        function toggleCheck() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body style="background-image: url('../media/online.png')">
    <div id="mainBlock1">
        <h1>Edit Profile</h1>
        <br><br><br>
        <div id="block">
            <form method="get">
                <input type="text" placeholder="Name" class="inputField" name="name" required />
                <input type="submit" value="Change Name" id="submitField" name="submitname" />
            </form>
            <form method="get">
                <input type="date" class="inputField" name="dob" required />
                <input type="submit" value="Change Date of Birth" id="submitField" name="submitdob" />
            </form>
            <form method="get">
                <input type="tel" placeholder="Phone No." class="inputField" name="phone" required />
                <input type="submit" value="Change Phone No." id="submitField" name="submitphone" />
            </form>
            <form method="get">
                <input type="text" placeholder="Address1" class="inputField" name="a1" required />
                <br><br>
                <input type="text" placeholder="Address2" class="inputField" name="a2" required />
                <input type="submit" value="Change Address" id="submitField" name="submitaddress" />
            </form>
            <form method="get">
                <input type="password" placeholder="Password" class="inputField" name="pass" required />
                <input type="submit" value="Change Password" id="submitField" name="submitpass" />
            </form>
            <input type="checkbox" onclick="toggleCheck()" />Show Password
        </div>
        <form action="../app/profile.php">
            <input type="submit" value="Finish Edit" id="submitField" />
        </form>
        <?php
        if (array_key_exists("submitname", $_GET)) {
            nameEdit();
        }
        if (array_key_exists("submitdob", $_GET)) {
            dobEdit();
        }
        if (array_key_exists("submitphone", $_GET)) {
            phnEdit();
        }
        if (array_key_exists("submitaddress", $_GET)) {
            addressEdit();
        }
        if (array_key_exists("submitpass", $_GET)) {
            pwdEdit();
        }
        ?>
    </div>
</body>

</html>