<?php
session_start();
include("../base.php");
$id = $_GET['ID'];
$pwd = $_GET['Password'];
$_SESSION['ID'] = $id;
$_SESSION['Password'] = $pwd;

if (loginUser($id, $pwd) == "false") {
    echo "error";
    sleep(3);
    echo "<br><a href='../auth/login.php'>Return to Login</a>";
} else {
    sleep(3);
    header("Location: ../app/app.php");
}
?>


<html>

<head>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <title>Login Control</title>
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