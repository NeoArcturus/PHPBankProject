<?php
session_start();
session_unset();
session_destroy();
sleep(3);
header("Location: ../main.html");
?>

<html>

<head>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
</head>

</html>