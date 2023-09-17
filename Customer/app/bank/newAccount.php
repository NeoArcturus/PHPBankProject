<?php
session_start();
include("../../base.php");
$id = $_SESSION['ID'];
$result = displayDetails($id);
?>

<html>

<head>
    <title>New Bank Account</title>
    <link rel="stylesheet" href="../../styles/bank.css" />
    <link rel="icon" type="image/x-icon" href="../../media/w.png" />

</head>

<body style="background-image: url('../../media/online.png')">
    <div id="buttonBox">
        <h1>User Options</h1>
        <br><br>
        <form>
            <input type="submit" value="Dashboard" id="optionButton" formaction="../app.php" />
            <br><br>
            <input type="submit" value="Account Statement" formaction="statement.php" id="optionButton" />
            <br><br>
            <input type="submit" value="Online Banking" formaction="banking.php" id="optionButton" />
        </form>
    </div>
    <div id="mainBlock">
        <h1>Create New Account</h1>
        <?php
        echo "<h3>Customer ID: " . $id . "</h3>";
        ?>
        <form id="Account" method="get" action="../../controller/newAccountControl.php">
            <label for="AccountNo">Choose your 8 digit account number</label>
            <input type="number" placeholder="AccountNo" name="AccountNo" id="input" required />
            <br><br>
            <label for="Type">Choose an Account Type</label>
            <select name="Type" id="atype" required form="Account">
                <option value="Savings">Savings</option>
                <option value="Current">Current</option>
                <option value="Fixed Deposit">Fixed Deposit</option>
            </select>
            <br><br>
            <input type="submit" value="Create Account" id="optionButton" name="Create" />
        </form>
    </div>
    <div id=" profileBlock">
        <form method="post">
            <input type="submit" value="<?php
            echo $result['Name'];
            ?>" id="profile" formaction="../profile.php" />
        </form>
    </div>
</body>

</html>