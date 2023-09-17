<?php
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
            <input type="submit" value="Customers" id="optionButton" name="customers" />
            <br><br>
            <input type="submit" value="Transactions" id="optionButton" name="transact" formaction="transaction.php" />
            <br><br>
            <input type="submit" value="Statements" id="optionButton" name="statements" />
            <br><br>
            <input type="submit" value="Loan Applicants" id="optionButton" name="loan" />
        </form>
    </div>
    <div id="mainBlock">
        <h1>Admin's Page</h1>
        <?php
        //Display customers of the bank
        if (array_key_exists("customers", $_POST)) {
            $result = customers();
            echo "<h2>Customers</h2><br>";
            echo "<table id='displayTable'>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Phone Number</th>
                    </tr>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>" . $row['CustomerID'] . "</td>
                        <td>" . $row['Name'] . "</td>
                        <td>" . $row['Date_of_Birth'] . "</td>
                        <td>" . $row['Phone'] . "</td>
                    </tr>";
                }
            }
            echo "</table>";
        }

        //Display Statements of the chosen customer
        if (array_key_exists('statements', $_POST)) {
            $result = customers();
            echo "<h2>Statements</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='Customer'>Choose a Customer-ID: </label>
                    <select name='Customer' id='customer' required>
                        <option disabled>Choose Customer-ID</option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['CustomerID'] . "'>" . $row['CustomerID'] . "</option>";
                }
            }
            echo "</select>
                <br><br>
                <input type='submit' name='statement' value='Select' id='optionButton' />
                </form>";
        }
        if (array_key_exists("statement", $_POST)) {
            echo "<h2>Statements</h2>";
            $id = $_POST['Customer'];
            echo "<h3>Customer-ID: " . $id . "</h3>";
            echo "<table id='displayTable1'>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Account No.</th>
                        <th>Beneficiary</th>
                        <th>Amount Credited</th>
                        <th>Amount Debited</th>
                        <th>Date of Transaction</th>
                        <th>Time of Transaction</th>
                    </tr>";
            $result = statement($id);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                        "<tr>
                            <td>" . $row['TransactID'] . "</td>
                            <td>" . $row['AccountNo'] . "</td>
                            <td>" . $row['Benefic_acc'] . "</td>
                            <td>" . $row['Deposit'] . "</td>
                            <td>" . $row['Withdrawn'] . "</td>
                            <td>" . $row['Transact_date'] . "</td>
                            <td>" . $row['Transact_time'] . "</td>
                        </tr>";
                }
            }
            echo "</table>";
            $rst = accounts($id);
            echo "Account Balance:<br>";
            if (mysqli_num_rows($rst) > 0) {
                while ($row = mysqli_fetch_assoc($rst)) {
                    echo "Account No: " . $row['AccountNo'] . " " . "Balance: " . $row['Curr_Bal'] . "<br>";
                }
            }
        }

        // Display Loan applicants
        if (array_key_exists("loan", $_POST)) {
            $result = loanApplicants();
            echo "<h2>Loan Applicants</h2><br>";
            echo "<table id='displayTable'>
                    <tr>
                        <th>Loan ID</th>
                        <th>Customer ID</th>
                        <th>Account No</th>
                        <th>Loan Description</th>
                        <th>Loan Amount</th>
                        <th>Duration</th>
                    </tr>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>" . $row['LoanID'] . "</td>
                        <td>" . $row['CustomerID'] . "</td>
                        <td>" . $row['AccountNo'] . "</td>
                        <td>" . $row['Loan_desc'] . "</td>
                        <td>" . $row['Amount'] . "</td>
                        <td>" . $row['Duration'] . "</td>
                    </tr>";
                }
            }
            echo "</table>";
            echo "<br><br>
                <form method='post' id='loanForm'>
                    <input type='submit' value='Approve Loan' id='optionButton' name='approve' />
                    <input type='submit' value='Reject Loan' id='optionButton' name='reject' />
                </form>";
        }
        // Approve Loan
        if (array_key_exists("approve", $_POST)) {
            $result = loanApplicants();
            echo "<h2>Loan Applicants</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='applicant'>Choose a Loan-ID: </label>
                    <select name='applicant' id='customer' required>
                        <option disabled>Choose Loan-ID</option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['LoanID'] . "'>" . $row['LoanID'] . "</option>";
                }
            }
            echo "</select>";
            echo "<br><br>
                <label for='Duration'>Amount of loan: </label>
                <select name='Duration' id='accounts' required />
                    <option disabled>Choose term duration</option>
                    <option value='1'>1 year</option>
                    <option value='2'>2 years</option>
                    <option value='5'>5 years</option>
                    <option value='10'>10 years</option>
                    <option value='15'>15 years</option>
                    <option value='20'>20 years</option>
                </select>";
            echo "<br><br>
                <input type='submit' name='Approve' value='Select' id='optionButton' />
                </form>";
        }
        if (array_key_exists("Approve", $_POST)) {
            $id = $_POST['applicant'];
            $dur = $_POST['Duration'];
            $result = loanApplicant($id);
            $rate = 0;
            if ($result['Loan_desc'] == "education")
                $rate = 15.00;
            if ($result['Loan_desc'] == "house")
                $rate = 20.00;
            if ($result['Loan_desc'] == "vehicle")
                $rate = 20.00;
            if ($result['Loan_desc'] == "business")
                $rate = 35.00;
            if ($result['Loan_desc'] == "personal")
                $rate = 10.00;
            $rst = approveLoan($id, $dur, $rate);
            if ($rst == "true")
                echo "Loan has been approved for this applicant!";
            else
                echo "Error occured!";
        }
        // Reject loan 
        if (array_key_exists("reject", $_POST)) {
            $result = loanApplicants();
            echo "<h2>Loan Applicants</h2><br>";
            echo "<form id='statement' method='post'>
                    <label for='applicant'>Choose a Loan-ID: </label>
                    <select name='applicant' id='customer' required>
                        <option disabled>Choose Loan-ID</option>";
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['LoanID'] . "'>" . $row['LoanID'] . "</option>";
                }
            }
            echo "</select>
                <br><br>
                <input type='submit' name='Reject' value='Select' id='optionButton' />
                </form>";
        }
        if (array_key_exists("Reject", $_POST)) {
            $id = $_POST['applicant'];
            $rst = rejectLoan($id);
            if ($rst == "true")
                echo "Loan has been rejected for this applicant!";
            else
                echo "Error occured!";
        }
        ?>
    </div>
    <div>
        <form>
            <input type="submit" value="Logout" formaction="../controller/logoutControl.php" id="logout" />
        </form>
    </div>
</body>

</html>