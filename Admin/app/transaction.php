<?php
session_start();
include("../base.php");
?>

<html>

<head>
    <title>Admin App</title>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <link rel="stylesheet" href="../styles/app.css" />
</head>

<body>
    <div id="Options">
        <h2>Admin Options</h2>
        <form method="post">
            <input type="submit" value="Credit Money" id="optionButton" name="credit" />
            <br><br>
            <input type="submit" value="Debit Money" id="optionButton" name="debit" />
            <br><br>
            <input type="submit" value="Dashboard" id="optionButton" name="dash" formaction="admin.php" />
        </form>
    </div>
    <div id="mainBlock">
        <h1>Transaction Page</h1>
        <?php
        //Credit Account
        if (array_key_exists("credit", $_POST)) {
            $result = customers();
            echo "<h2>Credit Account</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='Customer'>Choose a Customer-ID: </label>
                    <select name='Customer' id='customer' required>
                        <option disabled>Choose Account</option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                }
            }
            echo "</select>
            <br><br>
            <input type='submit' name='customer1' value='Select' id='optionButton' />
            </form>";
        }
        if (array_key_exists("customer1", $_POST)) {
            $id = $_POST['Customer'];
            $_SESSION['Customer'] = $id;
            $rst = accounts($id);
            echo "<h2>Credit Account</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='Account'>Choose account number of the customer: </label>
                    <select name='Account' id='account' required>
                    <option disabled>Choose Account</option>";
            if (mysqli_num_rows($rst) > 0) {
                while ($row = mysqli_fetch_assoc($rst)) {
                    echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                }
            }
            echo "</select>
            <br><br>
            Enter amount: <input type='number' name='amount' placeholder='Amount' id='optionButton' required />
            <br><br>
            <input type='submit' name='account1' value='Select' id='optionButton' />
            </form>";
        }
        if (array_key_exists("account1", $_POST)) {
            addMoney($_SESSION['Customer'], $_POST['Account'], $_POST['amount']);
        }

        // Debit Account
        if (array_key_exists("debit", $_POST)) {
            $result = customers();
            echo "<h2>Debit Account</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='Customer'>Choose a Customer-ID: </label>
                    <select name='Customer' id='customer' required>
                        <option disabled>Choose Account</option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                }
            }
            echo "</select>
            <br><br>
            <input type='submit' name='customer2' value='Select' id='optionButton' />
            </form>";
        }
        if (array_key_exists("customer2", $_POST)) {
            $id = $_POST['Customer'];
            $_SESSION['Customer'] = $id;
            $rst = accounts($id);
            echo "<h2>Credit Account</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='Account'>Choose account number of the customer: </label>
                    <select name='Account' id='account' required>
                    <option disabled>Choose Account</option>";
            if (mysqli_num_rows($rst) > 0) {
                while ($row = mysqli_fetch_assoc($rst)) {
                    echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                }
            }
            echo "</select>
            <br><br>
            Enter amount: <input type='number' name='amount' placeholder='Amount' id='optionButton' required />
            <br><br>
            <input type='submit' name='account2' value='Select' id='optionButton' />
            </form>";
        }
        if (array_key_exists("account2", $_POST)) {
            $acc = $_POST['Account'];
            $rst = account($acc);
            if ($rst['Curr_Bal'] >= $_POST['amount'])
                drawMoney($_SESSION['Customer'], $_POST['Account'], $_POST['amount']);
            else
                echo "<script>alert('Transaction unsuccessful! Low Balance');</script>";
        }
        ?>
    </div>
    <div>
        <form>
            <input type="submit" value="Logout" formaction="../controller/logoutControl.php" id="logout" />
        </form>
    </div>

</html>