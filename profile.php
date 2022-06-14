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
    require_once(__DIR__ . '/profile_pages/editProfile.php');
    require_once(__DIR__ . '/profile_pages/favorites.php');
    require_once(__DIR__ . '/profile_pages/myRestaurant.php');
    require_once(__DIR__ . '/profile_pages/orders.php');

    $session = new Session();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,1,0"/>
        <link rel="stylesheet" href="css/headerFooter.css">
        <link rel="stylesheet" href="css/favorites.css">
        <link rel="stylesheet" href="css/cart.css">
        <link rel="stylesheet" href="css/warnings.css">
        <link rel="stylesheet" href="css/myrestaurant.css">
        <link rel="stylesheet" href="css/inputBox.css">
        <link rel="stylesheet" href="css/profile.css">
        <link rel="stylesheet" href="css/restaurantPage.css">
        <link rel="stylesheet" href="css/restaurantList.css">
        <link rel="stylesheet" href="css/reviews.css">


        <script type="text/javascript" src="js/carrosselSliderFavRest.js" defer></script>
        <script type="text/javascript" src="js/carrosselSliderMyRest.js" defer></script>
        <script type="text/javascript" src="js/carrosselSliderFavDish.js" defer></script>
        <script type="text/javascript" src="js/cart.js" defer></script> 
        <script type="text/javascript" src="js/orders_list.js" defer></script>
        <script type="text/javascript" src="js/imagePreview.js" defer></script>
        <script type="text/javascript" src="js/validateProfile.js" defer></script>
        <script type="text/javascript" src="js/deleteAccountPopup.js" defer></script>
         
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    <main>

    <article id="profile_page">
        <nav id="aside">
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
            
                <a class="menu_option" href="profile.php?page=restaurantOrders">
                <span class="material-symbols-outlined">restaurant</span>
                    <p>My Restaurants Orders</p>
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
        }else if ($page === 'restaurantOrders') {
            show_owner_orders();
        }
        ?>

    </article>

    </main>

    <?php 
        if ($page === 'orders' || $page === 'restaurantOrders') {
            show_order_details_popup();
        }

    ?>

    <div class = "background_filter">

    </div>
    <?php create_delete_popup(); ?>

    <?php show_footer(); ?>

    </body>
</html>