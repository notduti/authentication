<!DOCTYPE html>
<html>

    <head>
        <title>New account for armadilli</title>

        <?php

            include_once "./auth/AuthFunctions.php";
            include_once "./auth/cookie.php";
            include_once "./auth/loginModel.php";

            $user = null;
    
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                if(isset($_POST['btnSubmit'])) {

                    $username = $_POST['txtNewUsername'];
                    $password = $_POST['txtNewPassword'];
                    $confirmedPassword = $_POST['txtConfirmNewPassword'];

                    if((strcmp($username, "") != 0) &&
                        (strcmp($password, "") != 0) && 
                        (strcmp($confirmedPassword, "") != 0) &&
                        (strcmp($confirmedPassword, $password) == 0))
                        $user = createUser($username, $password);

                    if(strcmp($confirmedPassword, $password) != 0)
                        echo("<p style = 'color: red'>Password must be the same</p>");

                    if($user != null) header("Location:login.php");
                    else echo("<p style = 'color: red'>Invalid fields</p>");
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
            <label>Confirm password</label>
            <input type = "password" id = "txtConfirmNewPassword" name = "txtConfirmNewPassword">
            <br>
            <br>
            <input style = "background-color: #04AA6D;" class = "button" type = "submit" id = "btnSubmit" name = "btnSubmit" value = "Create account">
        </form>
    
    </body>

</html>