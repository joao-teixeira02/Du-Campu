<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');
    require_once(__DIR__ . '/database/user.class.php');
    require_once(__DIR__ . '/database/owner.class.php');
    require_once(__DIR__ . '/database/restaurant.class.php');
    require_once(__DIR__ . '/database/state.class.php');
    require_once(__DIR__ . '/database/order.class.php');
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/profile_pages/profile.php');
    require_once(__DIR__ . '/profile_pages/favorites.php');
    require_once(__DIR__ . '/profile_pages/my_restaurant.php');
    require_once(__DIR__ . '/profile_pages/orders.php');

    $session = new Session();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,1,0"/>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <link rel="stylesheet" href="css/favoritesJoao.css">
        <link rel="stylesheet" href="css/myrestaurant.css">
        <link rel="stylesheet" href="css/input_box.css">
        <link rel="stylesheet" href="css/profile.css">

        <script type="text/javascript" src="js/carrosselSliderFavRest.js" defer></script>
        <script type="text/javascript" src="js/carrosselSliderMyRest.js" defer></script>
        <script type="text/javascript" src="js/carrosselSliderFavDish.js" defer></script>
        <script type="text/javascript" src="js/cart.js" defer></script> 
        <script type="text/javascript" src="js/orders_list.js" defer></script>
        <script type="text/javascript" src="js/myRestaurant.js" defer></script>
         
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    <main>

    <article id="profile_page">
        <nav id="aside">
            <a class="menu_option" href="index.php">
            <span class="material-symbols-outlined">home</span>
                <p>Home</p>
            </a>
            <a class="menu_option" href="profile.php?page=account">
            <span class="material-symbols-outlined">account_circle</span>
                <p>Account</p>
            </a>
            <a class="menu_option" href="profile.php?page=favorites">
            <span class="material-symbols-outlined">favorite</span>
                <p>Favorites</p>
            </a>
            
            <a class="menu_option" href="profile.php?page=orders">
                <span class="material-symbols-outlined">list_alt</span>
                <p>Orders</p>
            </a>
            
            <?php $db = getDatabaseConnection();
            
            if(!User::isCustomer($db, $session->getUsername())) { ?>
                <a class="menu_option" href="profile.php?page=myRestaurants">
                <span class="material-symbols-outlined">restaurant</span>
                    <p>My Restaurants</p>
                </a>
            <?php
            }
            ?>
        </nav>
        
        <?php 
        
        $page = $_GET['page'];
        if ( !isset($_GET['page']) || $page === 'account') {
            show_profile();
        }
        else if ($page === 'myRestaurants' && !User::isCustomer($db, $session->getUsername())) {
            show_restaurants();
        }
        else if ($page === 'favorites') {
            show_favorites();
        }else if ($page === 'orders') {
            show_orders();
        }
        ?>

    </article>

    </main>

    <?php 
        if ($page === 'orders') {
            show_order_details_popup();
        }

    ?>

    <?php show_footer(); ?>

    </body>
</html>