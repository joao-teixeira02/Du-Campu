<?php
    require_once('template/essentials.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?show_header_menu();?>

    <section class="login">
        <div class = "login_box">
            <h2> Login</h2>
            <form>
                <br>

                <div class="input_div">
                    <input class="input" type="text" placeholder=" " id="username_input"/>
                    <label for="username_input" class="input_label">Username</label>
                </div>   
                
                <br>

                <div class="input_div">
                    <input class="input" type="password" placeholder=" " id="password_input"/>
                    <label for="password_input" class="input_label">Password</label>
                </div>  

                <br>

                <input type="button" class="white_button" value="Login">

                
                <p class="black_button">Register</p>
            </from>
        </div>

    </section>

    <?show_footer();?>
    </body>
</html>