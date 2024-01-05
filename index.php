<!DOCTYPE html>
<html>

    <head>

        <?php 
        
            include_once "./auth/cookie.php"; 

            if($_SERVER["REQUEST_METHOD"] == "POST") {

                if(isset($_POST['btnLogout'])) {

                    $user = LoginDAO::readByToken($_COOKIE['token']);

                    $user->setToken("");
                    $user->setValidFrom(0);
                    $user->setExpire(0);

                    LoginDAO::update($user);

                    header("Location:login.php");
                }
            }
        ?>

        <title>Home</title>
        <link rel = "stylesheet" href = "./style/indexStyle.css">

    </head>

    <?php if(readCookie() == true) { ?>

        <body>

            <img class = "center" src = "./img/armadillo.jpg"></img>

            <form method = "POST" action = "index.php">
                <input style = "background-color: #E9967A;" class = "button" type = "submit" id = "btnLogout" name = "btnLogout" value = "Logout">
            </form>

        </body>

    <?php } else { ?>

        <body>

            <p>You're not allowed to see this page.</p>
            <a href = "login.php">Login here.</a>

        <body>

    <?php } ?>

</html>

