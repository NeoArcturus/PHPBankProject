<?php
include("../base.php");
$name = $_GET['name'];
$name = strtoupper($name);
$dob = $_GET['dob'];
$pwd = $_GET['pass'];
$phn = $_GET['phone'];
$ar1 = $_GET['a1'];
$ar2 = $_GET['a2'];
$c = $_GET['city'];
$s = $_GET['state'];
$p = $_GET['pin'];

$a1 = $ar1 . ", " . $ar2;
$a2 = $c . ", " . $s . "-" . $p;
?>

<html>

<head>
    <title>Register</title>
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
    <div id="head">
        <h1>ONLINE BANKING</h1>
    </div>
    <div id="mainBlock">
        <h1>REGISTER</h1>
        <form method="get" id="formBlock">
            <input type="text" placeholder="Name" class="inputField" name="name" />
            <br>
            <h3>Date of Birth: <input type="date" placeholder="Date of Birth" class="inputField" name="dob" /></h3>
            <br>
            <input type="tel" placeholder="Phone Number" class="inputField" name="phone" />
            <input type="text" placeholder="Address Line 1" class="inputField" name="a1" />
            <br><br>
            <input type="text" placeholder="Address Line 2" class="inputField" name="a2" />
            <input type="text" placeholder="City" class="inputField" name="city" />
            <br><br>
            <input type="text" placeholder="State" class="inputField" name="state" />
            <input type="number" placeholder="Pincode" class="inputField" name="pin" />
            <br><br>
            <h3>Set your password: <input type="password" placeholder="Password" class="inputField" name="pass"
                    id="password" /></h3>
            <input type="checkbox" onclick="toggleCheck()" />Show Password
            <br><br>
            <input type="submit" formaction="" id="inputField1" value="Submit" name="Submit" onclick="alert_f()" />
            <input type="reset" id="inputField1" value="Reset" />
            <input type="submit" formaction="../main.html" value="Main Menu" id="inputField1" />
        </form>
        <?php
        if (array_key_exists("Submit", $_GET)) {
            registerUser($name, $phn, $dob, $a1, $a2, $pwd);
            echo "<form>
                    <input type='submit' value='Go to Login' formaction='../auth/login.php' id='inputField1'/>
                    </form>";
        }
        ?>
    </div>
</body>

</html>