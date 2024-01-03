<!DOCTYPE html>
<html>

    <head>
        <title>New account for armadilli</title>

        <?php

            include_once "./auth/AuthFunctions.php";
    
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if(isset($_POST['btnSubmit'])) {

                    $username = $_POST['txtNewUsername'];
                    $password = $_POST['txtNewPassword'];
                    echo("<p>passa</p>");
                    createUser($username, $password);
                    
                    header("Location:login.php");
                }
            }
            
        ?>
        <link rel = "stylesheet" href = "./style/loginStyle.css">
    </head>

    <body>

        <h2>Sign up</h2>
        <form method = "POST" action = "newAccount.php">

            <label>Username</label>
            <input type = "text" id = "txtNewUsername" name = "txtNewUsername">
            <br>
            <br>
            <label>Password</label>
            <input type = "password" id = "txtNewPassword" name = "txtNewPassword">
            <br>
            <br>
            <input style = "background-color: #04AA6D;" class = "button" type = "submit" id = "btnSubmit" name = "btnSubmit" value = "Create account">
        </form>
    
    </body>

</html>