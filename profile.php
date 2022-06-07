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

    $session = new Session();

    function show_favorites() {

        global $session;

        $id = $session->getUserId();

        $db = getDatabaseConnection();
        ?>

    <article class="favorites">

    <h2>Restaurants</h2>

    <?php

        if ($session->isLogged()) { 
            $favRestaurants = User::getFavRestaurants($db, $id);
            $favDishes = User::getFavDishes($db, $id);?>
        <section class="favRestaurants">
            <?php 
            if (sizeof($favRestaurants) === 0) { ?>
                <!--<img id="noFavs" src="images/noFavs.png">-->
                <input type="button" class="goTo" value="Seems like you have no favorite restaurants yet. Click here to visit our restaurants page to find some!" onclick="location.href='restaurants.php'"/>
                <?php
            }
            else { ?>
                <button class="pre-btn1"><img src="images/arrow.png" alt=""></button>
                <button class="nxt-btn1"><img src="images/arrow.png" alt=""></button>
                <?php
                foreach($favRestaurants as $favRestaurant) { ?>
                    <div class="restaurant-cont">
                        <div class="restaurant_img">
                            <img class="thumb" alt="Imagem do Restaurante" src="<?php echo ($favRestaurant->getPhoto($db, $favRestaurant->id)); ?>">
                            <input type="button" class="card-btn" value="See Restaurant" onclick="location.href='restaurant.php?id=<?php echo($favRestaurant->id); ?>'"/>
                        </div>
                        <h3>
                            <?php echo($favRestaurant->getName()); ?>
                        </h3>

                    </div>
                    <?php
                }
            }
            ?>
        </section>
        <h2>Dishes</h2>
        <section class="favDishes">
            <?php
            if (sizeof($favDishes) === 0) { ?>
                <!--<img id="noFavs" src="images/noFavs.png">-->
                <input type="button" class="goTo" value="Seems like you have no favorite dishes yet. Click here to visit our restaurants page to find some!" onclick="location.href='restaurants.php'"/>
                <?php
            }
            else { ?>
                <button class="pre-btn2"><img src="images/arrow.png" alt=""></button>
                <button class="nxt-btn2"><img src="images/arrow.png" alt=""></button>
                <?php
                foreach($favDishes as $favDish) { ?>
                <div class="dish-cont">
                    <div class="dish_img">
                        <img class="thumb" alt="Imagem do Prato" src="<?php echo ($favDish->getPhoto($db, $favDish->id)); ?>">
                        <input type="button" class="card-btn" value="See Dish" onclick="location.href='restaurant.php?id=<?php echo($favDish->restaurant_id); ?>#<?php echo($favDish->getType($db)); ?>'"/>

                    </div>
                    <h3>
                        <?php echo($favDish->name); ?>
                    </h3>
                </div>
            <?php
                }

            }

            ?>
        </section>
    </article>
    <?php
        }
    }

    function show_restaurants() {

        global $session;

        $id = $session->getUserId();

        $db = getDatabaseConnection();

        if($session->isLogged()) {
            if (!User::isCustomer($db, $session->getUsername())) {
    ?>
        <script type="text/javascript" src="js/priceImageChange.js" defer></script>

        <section id="restaurant_list">

            <?php show_restaurant_list(); ?>

            <!-- <form id="add-restaurant">
                <input class="input" type="text" placeholder="Restaurant name" name="n" id="restaurant_input" required="required">
                <input class="input" type="text" placeholder="Address" name="a" id="address_input" required="required">
                <input class="input" type="text" placeholder="Categories separated by comma" name="c" id="categories_input" required="required">
                <input type="radio" id="€" name="pr" value="€"> 
                <label for="euro" > <img clickable src="images/euro.png" id="euro" width="47px" height="40px" alt="euro" ></label>
                <input type="radio" id="€€" name="pr" value="€€"> 
                <label for="doiseuro" > <img clickable src="images/2euro.png" id="doiseuro" width="50px" height="40px" alt="2euro"></label>
                <input type="radio" id="€€€" name="pr" value="€€€"> 
                <label for="treseuro" > <img clickable src="images/3euro.png" id="treseuro" width="55px" height="40px" alt="3euro"></label>
                <input type="hidden" name="id" value="</*?phpecho($id); ?>*/">
                
                <input formaction="/action/action_add_restaurant.php" formmethod="post" type="submit" class="white_button" value="Insert">
            </form>-->
                
            <a class="addButton" href="index.php">
                <img src="images/plus.png"/>
                <p>Add Restaurant</p>
            </a>

            <a class="addButton" href="index.php">
                <img src="images/orders.png"/>
                <p>See Restaurant's orders</p>
            </a>

        </section>

    <?php
            }
        }
    }

    function show_restaurant_list(){

        global $session;

        $db = getDatabaseConnection();

        $id = $session->getUserId();
        ?>


        <?php $restaurants = Owner::getRestaurants($db, $id);
        foreach($restaurants as $restaurant) {?>

            <div class="restaurant-container">

                <img id="restaurant-img" alt="Imagem do Restaurante" src="<?php echo ($restaurant->getPhoto($db, $id)); ?>">
                
                <div class="restaurant-info">
                    <?php echo($restaurant->getName()); ?>
                </div>

                <!-- <form>
                    <input class="input" type="text" placeholder="Dish name" name="n" id="dish_input" required="required">
                    <input class="input" type="number" step="0.01" placeholder="Price" name="p" id="price_input" required="required">
                    <input class="input" type="text" placeholder="Dish type" name="t" id="type_input" required="required">
                    <input type="hidden" name="id" value="</*?php echo($restaurant->id); ?*/>"> 
                    
                    <input formaction="/action/action_add_dish.php" formmethod="post" type="submit" class="white_button" value="Insert">
                </form> -->

        </div>

        <?php
        }
        ?>
        </ul>

    <?php
    }

    function show_profile() {

    
        global $session;
        $db = getDatabaseConnection();
        $user_photo =  User::getUser($db, $session->getUsername())->getPhoto($db);

        ?>

        <section id="profile">
        <h1>Personal Information</h1>
            <section id="account">
                <section id="fields">
                    <form action="/action/action_profile.php" method="post" class="profile_form">
                        <label>Name</label>
                        <input name="n" class="attr" type="text" placeholder="Name" value="<?php echo $session->getName(); ?>" required="required">
                        <label>Username</label>
                        <input name="u" class="attr" type="text" placeholder="Username" value="<?php echo $session->getUsername(); ?>" required="required">
                        <label>Email</label>
                        <input name="m" class="attr" type="text" placeholder="Email" value="<?php echo $session->getEmail(); ?>" required="required">
                        <label>Phone</label>
                        <input name="ph" class="attr" type="text" placeholder="Phone Number" value="<?php echo $session->getPhone(); ?>">
                        <label>Address</label>
                        <input name="a" class="attr" type="text" placeholder="Address" value="<?php echo $session->getAddress(); ?>">
                        <label>Password</label>
                        <input name="p" class="attr" type="password" placeholder="Password" value="<?php echo $session->getPassword(); ?>" required="required">
                        <input type="submit" name="Submit" value="Update">
                    </form>
                    <form>
                        <input formaction="/action/action_logout.php" type="submit" value="Logout">
                    </form>
                    <form>
                        <input formaction="/action/action_delete_account.php" type="submit" value="Delete Account">
                    </form>
                </section>
                <div id="photo_field">
                    <form action="/action/action_profile.php" method="post" enctype="multipart/form-data">
                        <label>Photo</label>
                        <img id="photo" src="<?php echo $user_photo; ?>" alt="Profile Picture">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" name="Submit" value="Upload">
                    </form>
                </div>
            </section>
        </section>
    <?php

    }

    function print_order(Order $order){
        $db = getDatabaseConnection();
        $restaurant = $order->getRestaurant($db);
        ?>
        <article class="order">
            <header>
                <h2><?php echo $restaurant->name ?></h2>
            </header>
            <main>
                <span class="date"><?php echo $order->date;?></span>
                <span class="price">Total Check: <?php echo number_format($order->getTotalPrice($db),2);?>€</span>
                <span class="state">State: <?php echo State::getStatebyId( $db, $order->state_id)->name;?></span>
                <span class="details" data-id_order='<?php echo $order->id;?>' onclick="open_details_popup(this)" >See details</span>
            <main>
        </article>

        <?php

    }

    function show_orders(){
        global $session;

        $db = getDatabaseConnection();
        $states = State::getStatus($db); 
        ?>

        <article class="page">
            
        <article id="active_orders" >
                <header>
                    <h1>Active Orders</h1>
                </header>

                <main>
                        <?php
                        $orders = Order::getOrderActive($db, $session->getUserId());
                        
                        ?> 

                        <ul> 

                        <?php
                        foreach($orders as $order){
                            print_order($order);
                        }

                        ?>

                        </u>
                        
                </main>
            </article>

            <article id="historico">
                <header>
                    <h1>Order History</h1>
                </header>

                <main>

                        <?php
                        $delivered_state = 4;
                        $orders = Order::getOrderWithState($db, $delivered_state, $session->getUserId());
                        ?> 

                        <ul> 

                        <?php
                        foreach($orders as $order){
                            print_order($order);
                        }

                        ?>

                        </u>
                        
                </main>
            </article>

        </article>


        <?php
    }

    function show_order_details_popup(){
        ?>

        <div class = "background_filter">

        </div>

        <article id="popup_order_details" class="full_window_popup">

            <header>
                <img clickable class="cross" src="images/close.png" onclick="close_details_popup()">
                <h1 id="restaurant_name"> Restaurant name</h1>
                <span id="TotalPrice">20 €</span>
            </header>

            <main>
                
                
                <table>
                <tr>
                    <th>Quantity</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Prato Muita Bom</td>
                    <td>10 €</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Prato Muita MAU</td>
                    <td>10 €</td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Prato Muita d</td>
                    <td>10 €</td>
                </tr>
                </table>
                

            </main>

        </article>

        <?php

    }

    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,1,0"/>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <link rel="stylesheet" href="css/favoritesJoao.css">
        <script type="text/javascript" src="js/carrosselSliderFavRest.js" defer></script>
        <script type="text/javascript" src="js/carrosselSliderFavDish.js" defer></script>
        <link rel="stylesheet" href="css/profile.css">
        <script type="text/javascript" src="js/cart.js" defer></script> 
        <script type="text/javascript" src="js/orders_list.js" defer></script> 
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