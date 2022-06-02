<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');

    $session = new Session();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <link rel="stylesheet" href="registerInes.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <main class = "register">

        <section class="registerContainer">

            <div class = "register_box">

                <div class = "logo">
                <a href = "index.php"> <img src = "images/logo.png"> </a>
                </div> 

                <h2>Register</h2>
                <form >
                    <br>

                     <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="name_input" value="<?php echo $session->getName(); ?>" required="required"/> 
                        <label for="name_input" class="input_label">Name</label>
                    </div>   
                    
                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="username_input" value="<?php echo $session->getUsername(); ?>" required="required"/>
                        <label for="username_input" class="input_label">Username</label>
                    </div>   

                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="mail_input" value="<?php echo $session->getEmail(); ?>" required="required"/>
                        <label for="mail_input" class="input_label">Email</label>
                    </div> 
                        
                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="phone_input" value="<?php echo $session->getPhone(); ?>" required=""/>
                        <label for="phone_input" class="input_label">Phone Number</label>
                    </div> 

                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder=" " name="u" id="address_input" value="<?php echo $session->getAddress(); ?>" required=""/>
                        <label for="address_input" class="input_label">Address</label>
                    </div> 

                    <br>

                    <div class="input_div">
                        <input class="input" type="password" placeholder=" " name="p" id="password_input" value="<?php echo $session->getPassword(); ?>" required="required"/>
                        <label for="password_input" class="input_label">Password</label>
                    </div>  

                    <br>   

                    <input formaction="/action/action_register.php" formmethod="post" type="submit" class="white_button" value="Register">
                    
                </form>

                <a href ="login.php">Already have an account? Login</a>

            </div>
        </section>

        <div class = "animationRegister">
            <img src="images/registerAnimation.svg" class="registerAnimation" alt="registerAnimation">
        </div>   

    </main>

</body>
</html>