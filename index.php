<?php
    require_once('user_session.php');
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

    <?show_header_menu(isLogged());?>

    <section class="mainPage">
        <img src = "images/DuCampua.jpg">
    </section>

    <?show_footer();?>
    </body>
</html>