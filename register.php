<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');

    $session = new Session();

    $flag = $_POST['flag'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <link rel="stylesheet" href="registerInes.css">
        <link rel="stylesheet" href="css/warnings.css">

        <script type="text/javascript" src="js/validateRegister.js" defer></script> 

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
                <form class="register_form">
                    <br>

                     <div class="input_div">
                        <input class="input" type="text" placeholder="" name="n" id="name_input" required="required"/> 
                        <label for="name_input" class="input_label">Name</label>
                        <span class="hint">Only letters</span>
                    </div>   
                    
                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder="" name="u" id="username_input" required="required"/>
                        <label for="username_input" class="input_label">Username</label>
                        <span class="hint">Only lowercase letters and numbers</span>
                    </div>   

                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder="" name="m" id="mail_input" required="required"/>
                        <label for="mail_input" class="input_label">Email</label>
                        <span class="hint">Not a valid email</span>
                    </div> 
                        
                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder="" name="ph" id="phone_input" required=""/>
                        <label for="phone_input" class="input_label">Phone Number</label>
                        <span class="hint">Must have 9 numbers</span>
                    </div> 

                    <br>

                    <div class="input_div">
                        <input class="input" type="text" placeholder="" name="a" id="address_input" required=""/>
                        <label for="address_input" class="input_label">Address</label>
                    </div> 

                    <br>

                    <div class="input_div">
                        <input class="input" type="password" placeholder="" name="p" id="password_input" required="required"/>
                        <label for="password_input" class="input_label">Password</label>
                    </div>  

                    <br>

                    <div class="input_div">
                        <input class="input" type="password" placeholder ="" name="p2" id="password_repeat_input" required="required"/>
                        <label for="password_input" class="input_label">Repeat Password</label>
                        <span class="hint">Passwords must match</span>
                    </div>

                    <br>   

                    <input type="hidden" name="flag" value="<?php echo ($flag); ?>"/>
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

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