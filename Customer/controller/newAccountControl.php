<?php
session_start();
include("../base.php");
$id = $_SESSION['ID'];
$acc_no = $_GET['AccountNo'];
$a_type = $_GET['Type'];

if (strlen($acc_no) != '8') {
    echo "Error!<br>Please choose an 8 digit account no.";
    echo "<br>Redirecting to previous page in 3 seconds...";
} else {
    $rst = createAccount($id, $a_type, $acc_no);
    if ($rst === "true") {
        echo "Account Created<br>Redirecting to previous page in 3 seconds...";
        sleep(5);
    } else {
        echo "error";
        sleep(5);
    }
}
?>

<html>

<head>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <script>
        setTimeout(function () {
            window.location.href = '../app/bank/newAccount.php';
        }, 2000);// for 2 second redirection
    </script>
</head>
<style>
    body {
        background-color: black;
        color: aqua;
    }

    a {
        color: aqua;
    }
</style>

</html>