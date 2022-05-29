<?php
    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <script type="text/javascript" src="js/cart.js" defer></script>
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu();?>

    <section class="login">
        <div class = "login_box">
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

                <input formaction="action_login.php" formmethod="post" type="submit" class="white_button" value="Login">

            </form>

            <form>
                <p>Don't have an account yet?</p>
                <input formaction="register.php" type="submit" class="black_button" value="Register">
            </form>

        </div>

    </section>

    <?php show_footer();?>
    </body>
</html>