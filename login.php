<!DOCTYPE html>
<?php

    include_once "./auth/AuthFunctions.php";
    include_once "./auth/cookie.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["btnSubmit"])) {

            $user = null;

            $username = $_POST["txtUsername"];
            $password = $_POST["txtPassword"];

            if((strcmp($username, "") != 0) && (strcmp($password, "") != 0))
                $user = LoginDAO::readByUsername($username);


            if($user != null) {

                if(isValid($user, $username, $password)) {
                    
                    if(!readCookie()) {

                        $token = createToken($user);
                        sendToken($token); 
                    }
                    header("Location:index.php");
                }
                else invalidUser();
            }
            else invalidUser();                
        }
    }
?>

<html>

    <head>
        <title>Login armadilli</title>
        <link rel = "stylesheet" href = "./style/loginStyle.css">
    </head>

    <body>
        <h2>Login/sign up</h2>
        <br>
        <form method = "POST" action = "login.php">

            <label>Username</label>
            <input type = "text" id = "txtUsername" name = "txtUsername">
            <br>
            <br>
            <label>Password</label>
            <input type = "password" id = "txtPassword" name = "txtPassword">
            <br>
            <br>
            <input style = "background-color: #04AA6D;" class = "button" type = "submit" id = "btnSubmit" name = "btnSubmit" value = "Submit">

        </form>
        <p>or</p>
        <form method = "POST" action = "newAccount.php">
            <input style = "background-color: #E9967A;" class = "button" type = "submit" id = "btnNewAccount" name = "btnNewAccount" value = "Create account">
        </form>

    </body>

</html>