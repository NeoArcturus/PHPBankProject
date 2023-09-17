<?php
session_start();
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

function registerUser($name, $phn, $dob, $a1, $a2, $pwd)
{
    global $conn;
    $sql = "INSERT INTO customers VALUES ('$name', '$dob', '$phn', '$a1', '$a2', 0, '$pwd')";
    if (mysqli_query($conn, $sql)) {
        echo "User added";
    } else {
        echo "error";
    }
}

function loginUser($id, $pwd)
{
    global $conn;
    $sql = "SELECT * FROM customers WHERE CustomerID='$id' AND Password='$pwd'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // The user exists
        return "true";
    } else {
        // The user does not exist
        return "false";
    }
}

function displayDetails($id)
{
    global $conn;
    $sql = "SELECT * FROM customers WHERE CustomerID='$id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $result;
}

function displayAccounts($id)
{
    global $conn;
    $sql = "SELECT * FROM accounts WHERE CustomerID='$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function displayAccount($acc_no)
{
    global $conn;
    $sql = "SELECT * FROM accounts WHERE AccountNo='$acc_no'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $result;
}

function createAccount($id, $acc_type, $acc_no)
{
    global $conn;
    $sql = "INSERT INTO accounts VALUES ('$id', '$acc_no', 0, '$acc_type', 0)";
    if (mysqli_query($conn, $sql)) {
        return "true";
    } else {
        return "false";
    }
}

function payMoney($id1, $id2, $acc1, $acc2, $amt, $ref)
{
    global $conn;
    $sql1 = "INSERT INTO statement VALUES ('$id1', '$acc1', 0, '$amt', '$acc2', CURDATE(), 0, CURTIME(), '$ref')";
    $sql2 = "INSERT INTO statement VALUES ('$id2', '$acc2', '$amt', 0, '$acc1', CURDATE(), 0, CURTIME(), '$ref')";
    if (mysqli_query($conn, $sql1) and mysqli_query($conn, $sql2)) {
        updateBalance($acc1, "-", $amt);
        updateBalance($acc2, "+", $amt);
        echo "<script>alert('Transaction successful!');</script>";
    } else
        echo "Error!";
}

function updateBalance($acc_no, $op, $amt)
{
    global $conn;
    $sql = "";
    switch ($op) {
        case "+":
            global $sql;
            $rst = displayAccount($acc_no);
            $amt = $amt + $rst['Curr_Bal'];
            $sql = "UPDATE accounts SET Curr_Bal='$amt' WHERE AccountNo='$acc_no'";
            break;
        case "-":
            global $sql;
            $rst = displayAccount($acc_no);
            $amt = $rst['Curr_Bal'] - $amt;
            $sql = "UPDATE accounts SET Curr_Bal='$amt' WHERE AccountNo='$acc_no'";
            break;
    }
    mysqli_query($conn, $sql);

}

function bankStatement($acc)
{
    global $conn;
    $sql = "SELECT * FROM statement WHERE AccountNo='$acc'";
    return mysqli_query($conn, $sql);
}

function loanApplication($id, $acc, $amt, $res)
{
    global $conn;
    $sql = "INSERT INTO loan VALUES (0, '$id', '$acc', '$amt', 0, 0, '', '$res', 0)";
    if (mysqli_query($conn, $sql)) {
        return "true";
    } else {
        return "false";
    }
}
?>