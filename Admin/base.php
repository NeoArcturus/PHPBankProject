<?php
session_start();
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db3');
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

function adminLogin($id, $pwd)
{
    global $conn;
    $sql = "SELECT * FROM admin WHERE ID='$id' AND Password='$pwd'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // The admin exists
        return "true";
    } else {
        // The admin does not exist
        return "false";
    }
}

function customers()
{
    global $conn;
    $sql = "SELECT * FROM customers ORDER BY CustomerID";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function statement($id)
{
    global $conn;
    $sql = "SELECT * FROM statement WHERE CustomerID='$id' ORDER BY Transact_date";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function accounts($id)
{
    global $conn;
    $sql = "SELECT * FROM accounts WHERE CustomerID='$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function account($acc_no)
{

    global $conn;
    $sql = "SELECT * FROM accounts WHERE AccountNo='$acc_no'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $result;
}

// Banking functions
function addMoney($id, $acc_no, $amt)
{
    global $conn;
    $sql = "INSERT INTO statement VALUES ('$id', '$acc_no', '$amt', 0, NULL, CURDATE(), 0, CURTIME(), 'Credit Amount')";
    $rst = updateBalance($acc_no, "+", $amt);
    if ($rst == "true") {
        if (!mysqli_query($conn, $sql)) // Check for errors.
            echo "<script>alert('Transaction unsuccessful!');</script>";
        else
            echo "<script>alert('Transaction successful!');</script>";
    } else
        echo "<script>alert('Transaction unsuccessful!');</script>";
}

function drawMoney($id, $acc_no, $amt)
{
    global $conn;
    $sql = "INSERT INTO statement VALUES ('$id', '$acc_no', 0, '$amt', NULL, CURDATE(), 0, CURTIME(), 'Debit Amount')";
    $rst = updateBalance($acc_no, "-", $amt);
    if ($rst == "true") {
        if (!mysqli_query($conn, $sql)) // Check for errors.
            echo "<script>alert('Transaction unsuccessful!');</script>";
        else
            echo "<script>alert('Transaction successful!');</script>";
    } else
        echo "<script>alert('Transaction unsuccessful!');</script>";
}

function updateBalance($acc_no, $op, $amt)
{
    global $conn;
    $sql = "";
    switch ($op) {
        case "+":
            global $sql;
            $rst = account($acc_no);
            $amt = $amt + $rst['Curr_Bal'];
            $sql = "UPDATE accounts SET Curr_Bal='$amt' WHERE AccountNo='$acc_no'";
            break;
        case "-":
            global $sql;
            $rst = account($acc_no);
            $amt = $rst['Curr_Bal'] - $amt;
            $sql = "UPDATE accounts SET Curr_Bal='$amt' WHERE AccountNo='$acc_no'";
            break;
    }
    $result = mysqli_query($conn, $sql);
    if ($result)
        return "true";
    else
        return "false";
}

function loanApplicants()
{
    global $conn;
    $sql = "SELECT * FROM loan ORDER BY LoanID, CustomerID";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function loanApplicant($id)
{
    global $conn;
    $sql = "SELECT * FROM loan WHERE LoanID='$id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $result;
}

function approveLoan($id, $dur, $rate)
{
    global $conn;
    $sql = "UPDATE loan SET Sanctioned='Y', Duration='$dur', Rate='$rate'";
    $result = mysqli_query($conn, $sql);
    if ($result)
        return "true";
    else
        return "false";
}

function rejectLoan($id)
{
    global $conn;
    $sql = "UPDATE loan SET Sanctioned='N'";
    $result = mysqli_query($conn, $sql);
    if ($result)
        return "true";
    else
        return "false";
}
?>