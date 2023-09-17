<?php
session_start();
include("../../base.php");
$id = $_SESSION['ID'];
$result = displayDetails($id);
?>

<html>

<head>
    <title>Online Banking</title>
    <link rel="stylesheet" href="../../styles/payment.css" />
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
            <input type="submit" value="Open New Account" id="optionButton" formaction="newAccount.php" />
        </form>
        </form>
    </div>
    <div id="mainBlock">
        <h1>Online Banking</h1>
        <div>
            <form id="heading" method="post">
                <input type="submit" id="optionButton1" value="Check Balance" name="balance" />
                <input type="submit" id="optionButton1" value="Send Money" name="send" />
                <input type="submit" id="optionButton1" value="Loan Money" name="loan" />
            </form>
        </div>
        <?php
        echo "<h2>Customer ID: " . $id . "<br></h2>";
        ?>
        <div id="paymentBlock">
            <?php
            //Check account Balance
            if (array_key_exists("balance", $_POST)) {
                $rst = displayAccounts($id);
                echo "<form id='addMoney' method='post'>
                    <label for='Accounts'>Your Accounts: </label>
                    <select name='Accounts' id='accounts' required>
                        <option disabled>Choose your Account No</option>";
                if (mysqli_num_rows($rst) > 0) {
                    while ($row = mysqli_fetch_assoc($rst)) {
                        echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                    }
                }
                echo "</select>
                <br><br>
                <input type='submit' name='Balance' value='Submit Account Selection' id='optionButton1' />
                </form>";
            }
            if (array_key_exists("Balance", $_POST)) {
                $rst2 = displayAccount($_POST['Accounts']);
                echo "<h3>Account Balance Available: " . $rst2['Curr_Bal'];
            }

            // Sending money to other person
            if (array_key_exists("send", $_POST)) {
                $_SESSION['transact'] = "Send";
                $rst = displayAccounts($id);

                echo "<form id='addMoney' method='post'>
                    <label for='Accounts'>Your Accounts: </label>
                    <select name='Accounts' id='accounts' required>
                        <option disabled>Choose your Account No</option>";
                if (mysqli_num_rows($rst) > 0) {
                    while ($row = mysqli_fetch_assoc($rst)) {
                        echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                    }
                }
                echo "</select>
                    <br><br>
                    <label for='Benefic'></label>
                    Enter the Beneficiary Account: <input type='number' id='optionButton1' placeholder='Account No.' name='Benefic' required />
                <br><br>
                <input type='submit' name='Send' value='Submit Account Selection' id='optionButton1' />
                </form>";
            }
            if (array_key_exists("Send", $_POST)) {
                sleep(3);
                $acc1 = $_POST['Accounts'];
                $acc2 = $_POST['Benefic'];
                $d1 = displayAccount($acc1);
                $d2 = displayAccount($acc2);
                echo "Your Account Selected for payment: " . $d1['AccountNo'] . "<br>Balance Available: " . $d1['Curr_Bal'];
                if ($d2 === false) {
                    echo "<br><br>Cannot find the beneficiary account!<br>Please re-enter once again by clicking on 'Send Money' button once again!";
                } else {
                    $b_details = displayDetails($d2['CustomerID']);
                    echo "<br><br>Beneficiary Account Selected for payment: " . $d2['AccountNo'] . "<br>Beneficiary Name: " . $b_details['Name'];
                    echo "<form id='money' method='post'>
                            <h3>Enter amount: <input type='number' placeholder='Amount in Rupees' id='optionButton1' name='amount' required /></h3>
                            <h3>Enter Account PIN: <input type='number' placeholder='Account PIN' name='pin' id='optionButton1' required /></h3>
                            <h3>Enter Transaction Reference: <input type='text' placeholder='Reference' name='ref' id='optionButton1' /></h3>
                            <input type='submit' id='optionButton1' value='Pay' formaction='../../controller/bankingControl.php' />
                            <input hidden type='number' name='Account1' value='" . $acc1 . "' />
                            <input hidden type='number' name='Account2' value='" . $acc2 . "' />
                            <input hidden type='number' name='CustomerID' value='" . $b_details['CustomerID'] . "' />
                        </form>";
                }
            }

            // Loan from bank
            if (array_key_exists("loan", $_POST)) {
                $_SESSION['transact'] = "Loan";
                $rst = displayAccounts($id);
                echo "<form id='addMoney' method='post'>
                    <label for='Accounts'>Your Accounts: </label>
                    <select name='Account' id='accounts' required>
                        <option disabled>Choose your Account No</option>";
                if (mysqli_num_rows($rst) > 0) {
                    while ($row = mysqli_fetch_assoc($rst)) {
                        echo "<option value='" . $row['AccountNo'] . "'>" . $row['AccountNo'] . "</option>";
                    }
                }
                echo "</select>";
                echo "<br><br>
                    <label>Amount of loan: </label>
                    <input type='number' placeholder='Enter amount' id='optionButton1' name='amount' required />";
                echo "<br><br>
                <br><br>
                <label>Reason for loan: </label>
                <select name='reason' id='accounts' required />
                    <option disabled>Choose a reason</option>
                    <option value='education'>For Education</option>
                    <option value='house'>For House/Property</option>
                    <option value='vehicle'>For Vehicle</option>
                    <option value='business'>For Business</option>
                    <option value='personal'>For Other Personal reasons</option>
                </select> 
                <br><br>
                <input type='submit' name='Loan' value='Submit Loan Application' id='optionButton1' formaction='../../controller/bankingControl.php' />";
            }
            ?>
        </div>
        <p>Select your accounts for adding money to your account, sending money to someone, withdraw money or lend some.
        </p>
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