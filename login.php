<?php
    require_once('user_session.php');
    require_once('template/essentials.tpl.php');
    

    

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(isLogged());?>

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

                <input formaction="action_login.php" formmethod="get" type="submit" class="white_button" value="Login">

                
                <p class="black_button">Register</p>
            </from>
        </div>

    </section>

    <?php show_footer();?>
    </body>
</html>