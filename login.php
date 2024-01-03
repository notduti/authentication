<!DOCTYPE html>
<?php

    include_once "./auth/AuthFunctions.php";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["btnSubmit"])) {

            $username = $_POST["txtUsername"];
            $password = $_POST["txtPassword"];
                    
            $user = LoginDAO::readByUsername($username);
            if($user != null) {

                if(isValid($user, $username, $password)) {

                    $token = createToken($user);
                    sendToken($token);   //il client avrà un cookie
                    header("Location:index.php");

                    //createToken = creamo il token, lo crittiamo, creamo validfrom e expires (numeri che indicano data e ora)
                }
                else invalidUser();
            }                
        }
    }/*
    if($_SERVER["REQUEST_METHOD"] == "GET") {
                
        $username = $_GET['user'];
        $user = LoginDAO::readByUsername($username);

        if($_COOKIE == $user->getToken()) {
                    
            echo "<p>aaaa</p>";
            if($user->getExpire() > time()) header("Location:index.php");
        }
    }*/
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