<?php
    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <link rel="stylesheet" href="css/loginInes.css">
        <link rel="stylesheet" href="css/warnings.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_warnings(); ?>

    <section class="login">

        <div class = "animation">
            <img src="images/loginAnimation.svg" class="loginAnimation" alt="loginAnimation">
        </div>    


        <div class = "loginContainer">

            <div class = "login_box">
            <div class = "logo">
                <a href = "index.php"> <img src = "images/logo.png"> </a>
            </div> 

                <h2> Login</h2>
                <form >
                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="username_input"/>
                        <label for="username_input" class="input_label">Username</label>
                    </div>   
                    
                    <br>

                    <div class="input_div">
                        <input class="input" type="password" placeholder=" " name="p" id="password_input"/>
                        <label for="password_input" class="input_label">Password</label>
                    </div>  

                    <br>

                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                    <input formaction="/action/action_login.php" formmethod="post" type="submit" class="white_button" value="Login">

                </form>

                <form>
                    <input type="hidden" name="flag" value="0"> 
                    <input formaction="register.php" formmethod="post" type="submit" class="registerPageBtn" value="Don't have an account yet? Register">
                </form>
                <form>
                    <input type="hidden" name="flag" value="1"> 
                    <input formaction="register.php" formmethod="post" type="submit" class="registerPageBtn" value="Create a business account">
                </form>

            </div>
        </div>    

    </section>

    </body>
</html>