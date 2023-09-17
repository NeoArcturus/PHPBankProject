<html>

<head>
    <title>Admin Login</title>
    <link rel="icon" type="image/x-icon" href="../media/w.png">
    <link rel="stylesheet" href="../styles/login.css" />
    <script type="text/javascript">
        function alert_f() {
            alert('Confirm Form Submission!');
        }
        function toggleCheck() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>

<body>
<div id="head">
        <h1>ADMIN LOGIN</h1>
    </div>
    <div id="mainBlock">
        <h1>LOGIN</h1>
        <form method="get" id="formBlock" action="../controller/loginControl.php">
            <input type="text" placeholder="Admin-ID" class="inputField" name="ID" />
            <br><br>
            <input type="password" placeholder="Password" class="inputField" name="Password" id="password" />
            <br>
            <input type="checkbox" onclick="toggleCheck()" />Show Password
            <br><br>
            <input type="submit" id="inputField1" value="Submit" onclick="alert_f()" />
            <input type="reset" id="inputField1" value="Reset" />
        </form>
        <form>
            <input type="submit" formaction="../main.html" value="Main Menu" id="inputField1" />
        </form>
    </div>
</body>

</html>