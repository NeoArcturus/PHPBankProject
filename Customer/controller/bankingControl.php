<?php
session_start();
include("../base.php");
$id = $_SESSION['ID'];
if ($_SESSION['transact'] == "Send") {
    $amt = $_POST['amount'];
    $pin = $_POST['pin'];
    $ref = $_POST['ref'];
    $acc1 = $_POST['Account1'];
    $acc2 = $_POST['Account2'];
    $id2 = $_POST['CustomerID'];
    $rst = displayAccount($acc1);
    if ($pin == $rst['AccountPin']) {
        //Payment only on pin check!
        if ($rst['Curr_Bal'] >= $amt)
            payMoney($id, $id2, $acc1, $acc2, $amt, $ref);
        else
            echo "<script>alert('Insufficient Balance!');</script>";
    } else
        echo "<script>alert('Invalid PIN');</script>";
}
if ($_SESSION['transact'] == "Loan") {
    $acc = $_POST['Account'];
    $amt = $_POST['amount'];
    $res = $_POST['reason'];
    $result = loanApplication($id, $acc, $amt, $res);
    if ($result)
        echo "<script>alert('Application successful!');</script>";
    else
        echo "<script>alert('Application unsuccessful!');</script>";
}
?>

<html>

<head>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <script>
        setTimeout(function () {
            window.location.href = '../app/bank/banking.php';
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