<?php
session_start();
include("../base.php");
$id = $_SESSION['ID'];
$pwd = $_SESSION['Password'];
$result = displayDetails($id);
?>

<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/app.css" />
    <link rel="icon" type="image/x-icon" href="../media/w.png">
</head>

<body style="background-image: url('../media/online.png')">
    <div id="optionBlock">
        <h1>User Options</h1>
        <form method="post" id="optionForm">
            <input type="submit" value="Open New Account" id="optionButton" formaction="bank/newAccount.php" />
            <br><br>
            <input type="submit" value="Account Statement" formaction="bank/statement.php" id="optionButton" />
            <br><br>
            <input type="submit" value="Display Accounts" id="optionButton" name="displayAccount" />
            <br><br>
            <input type="submit" value="Online Banking" formaction="bank/banking.php" id="optionButton" />
        </form>
    </div>
    <div id="mainBlock">
        <h1>Dashboard</h1>
        <?php
        if (array_key_exists("displayAccount", $_POST)) {
            echo "<h2>Your Active Accounts</h2>";
            $rst = displayAccounts($id);
            echo "<table id='displayTable'>
                    <tr>
                        <th>Customer ID</th>
                        <th>Account No.</th>
                        <th>Account Type</th>
                    </tr>";
            if (mysqli_num_rows($rst) > 0) {
                while ($row = mysqli_fetch_assoc($rst)) {
                    echo "
                    <tr>
                        <td>" . $row['CustomerID'] . "</td>
                        <td>" . $row['AccountNo'] . "</td>
                        <td>" . $row['AccountType'] . "</td>
                    </tr>";
                }
            }
            echo "</table>";
        }
        ?>
    </div>
    <div id="profileBlock">
        <form method="post">
            <input type="submit" value="<?php
            echo $result['Name'];
            ?>" id="profile" formaction="../app/profile.php" />
        </form>
    </div>
</body>

</html>