<?php
session_start();
include("../../base.php");
$id = $_SESSION['ID'];
$result = displayDetails($id);
?>

<html>

<head>
    <title>Account Statement</title>
    <link rel="stylesheet" href="../../styles/bank.css" />
    <link rel="icon" type="image/x-icon" href="../../media/w.png">
</head>

<body style="background-image: url('../../media/online.png')">
    <div id="buttonBox">
        <h1>User Options</h1>
        <form method="post">
            <br>
            <input type="submit" value="Dashboard" id="optionButton" formaction="../app.php" />
            <br><br>
            <input type="submit" value="Open New Account" formaction="newAccount.php" id="optionButton" />
            <br><br>
            <input type="submit" value="Online Banking" formaction="banking.php" id="optionButton" />
        </form>
    </div>
    <div id="mainBlock">
        <h1>Account Statement</h1>
        <p>Choose the account from the drop down menu and click submit to view statement.</p>
        <form id='addMoney' method='post'>
            <label for='Accounts'>Choose an Account Number: </label>
            <select name='Accounts' id='accounts' required>
                <option disabled>Choose Account</option>
                <?php
                $rst = displayAccounts($id);
                if (mysqli_num_rows($rst) > 0) {
                    while ($row = mysqli_fetch_assoc($rst)) {
                        echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                    }
                }
                ?>
            </select>
            <br><br>
            <input type='submit' name='submit' value='Select' id='optionButton' />
        </form>
        <?php
        if (array_key_exists("submit", $_POST)) {
            echo "<h2>Displaying account statement</h2>";
            $acc = $_POST['Accounts'];
            $rst1 = bankStatement($acc);
            echo "<table id='displayTable'>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Customer ID</th>
                        <th>Account No.</th>
                        <th>Beneficiary</th>
                        <th>Amount Credited</th>
                        <th>Amount Debited</th>
                        <th>Date of Transaction</th>
                        <th>Time of Transaction</th>
                        <th>Transaction Reference</th>
                    </tr>";
            if (mysqli_num_rows($rst1) > 0) {
                while ($row = mysqli_fetch_assoc($rst1)) {
                    echo
                        "<tr>
                        <td>" . $row['TransactID'] . "</td>
                        <td>" . $row['CustomerID'] . "</td>
                        <td>" . $row['AccountNo'] . "</td>
                        <td>" . $row['Benefic_acc'] . "</td>
                        <td>" . $row['Deposit'] . "</td>
                        <td>" . $row['Withdrawn'] . "</td>
                        <td>" . $row['Transact_date'] . "</td>
                        <td>" . $row['Transact_time'] . "</td>
                        <td>" . $row['Transact_ref'] . "</td>
                    </tr>";
                }
            }
            echo "</table>
                <br><br>
                <h3>All values shown here are up to date.<br>Any Change will be reflected as soon as data is updated.</h3>";
        }
        ?>
    </div>
    <div id=" profileBlock">
        <form method="post">
            <input type="submit" value="<?php
            echo $result['Name'];
            ?>" id="profile" formaction="../../app/profile.php" />
        </form>
    </div>
</body>

</html>