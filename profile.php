<?php
    declare(strict_types = 1);

    require_once('template/essentials.tpl.php');
    require_once('user_session.php');
    require_once('database/user.class.php');
    require_once('database/owner.class.php');
    require_once('database/restaurant.class.php');

    function show_favorites() {
        $id = getUserId();

        $db = getDatabaseConnection();

        if (isLogged()) { ?>
            <ul>
            <h2>Restaurants</h2>
            <?php 
            $favRestaurants = User::getFavRestaurants($db, $id);
            $favDishes = User::getFavDishes($db, $id);
            foreach($favRestaurants as $favRestaurant) { ?>
            <li>

                <img id="restaurant_img" alt="Imagem do Restaurante" src="<?php echo ($favRestaurant->getPhoto($db, $favRestaurant->id)); ?>">
            
                <h3>
                    <?php echo($favRestaurant->getName()); ?>
                </h3>
                <p id="classificao"><?php echo ($favRestaurant->calcRating($db, $favRestaurant->id));?>
                <?php
                    $categories = $favRestaurant->getCategory($db, $favRestaurant->id);
                    foreach($categories as $category){
                        echo (" • ");
                        echo ($category);
                    }
                ?>
                </p>

            </li>
            <?php
            }
            ?>
            </ul>
            <ul>
            <h2>Dishes</h2>
            <?php
            foreach($favDishes as $favDish) { ?>
            <li>
                <img id="dish_img" alt="Imagem do Prato" src="<?php echo ($favDish->getPhoto($db, $favDish->id)); ?>">
                <h3>
                    <?php echo($favDish->name); ?>
                </h3>
                <p>
                <?php
                    echo ($favDish->price . "€");
                    echo (" • ");
                    echo($favDish->getType($db));
                ?>
                </p>
            </li>

            <?php

            }

            ?>
            </ul>
    <?php
        }
    }

    function show_restaurants() {

        $id = getUserId();

        $db = getDatabaseConnection();

        if(isLogged()) {
            if (!User::isCustomer($db, $_SESSION['username'])) {
    ?>

        <section id="restaurant_list">

            <?php show_restaurant_list(); ?>

            <form>
                <input class="input" type="text" placeholder="Restaurant name" name="n" id="restaurant_input">
                <input class="input" type="text" placeholder="Address" name="a" id="address_input">
                <input class="input" type="text" placeholder="Categories separated by comma" name="c" id="categories_input">
                <input type="hidden" name="id" value="<?php echo($id); ?>">
                
                <input formaction="action_add_restaurant.php" formmethod="post" type="submit" class="white_button" value="Insert">
            </form>
        </section>

    <?php
            }
        }
    }

    function show_restaurant_list(){

        $db = getDatabaseConnection();

        $id = getUserId();
        ?>

        <ul>

        <?php $restaurants = Owner::getRestaurants($db, $id);
        foreach($restaurants as $restaurant) {?>

            <li>

            <img id="restaurant_img" alt="Imagem do Restaurante" src="<?php echo ($restaurant->getPhoto($db, $id)); ?>">
            
                <h3>
                    <?php echo($restaurant->getName()); ?>
                </h3>
                <p id="classificao"><?php echo ($restaurant->calcRating($db, $id));?>
                <?php
                    $categories = Restaurant::getCategory($db, $id);
                    foreach($categories as $category){
                        echo (" • ");
                        echo ($category);
                    }
                ?>
                </p>

                <form>
                    <input class="input" type="text" placeholder="Dish name" name="n" id="dish_input">
                    <input class="input" type="number" step="0.01" placeholder="Price" name="p" id="price_input">
                    <input class="input" type="text" placeholder="Dish type" name="t" id="type_input">
                    <input type="hidden" name="id" value="<?php echo($restaurant->id); ?>"> 
                    
                    <input formaction="action_add_dish.php" formmethod="post" type="submit" class="white_button" value="Insert">
                </form>

            </li>

        <?php
        }
        ?>
        </ul>

    <?php
    }

    function show_profile() { ?>
        <section id="profile">
        <h1>Personal Information</h1>
            <section id="account">
                <section id="fields">
                    <form action="action_profile.php" method="post" class="profile_form">
                        <label>Name</label>
                        <input name="n" class="attr" type="text" placeholder="Name" value="<?php echo getName(); ?>" required="required">
                        <label>Username</label>
                        <input name="u" class="attr" type="text" placeholder="Username" value="<?php echo getUsername(); ?>" required="required">
                        <label>Email</label>
                        <input name="m" class="attr" type="text" placeholder="Email" value="<?php echo getEmail(); ?>" required="required">
                        <label>Phone</label>
                        <input name="ph" class="attr" type="text" placeholder="Phone Number" value="<?php echo getPhone(); ?>">
                        <label>Address</label>
                        <input name="a" class="attr" type="text" placeholder="Address" value="<?php echo getAddress(); ?>">
                        <label>Password</label>
                        <input name="p" class="attr" type="password" placeholder="Password" value="<?php echo getPassword(); ?>" required="required">
                        <input type="submit" name="Submit" value="Update">
                    </form>
                    <form>
                        <input formaction="action_logout.php" type="submit" value="Logout">
                    </form>
                    <hr>
                    <input onclick="openDialog('Delete Account')" type="submit" value="Delete Account">

                </section>
                <div id="photo_field">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label>Photo</label>
                        <img id="photo" src="<?php echo 'https://www.altoastral.com.br/media/_versions/legacy/2016/09/bebe-comendo-papinha-inteligencia_widexl.jpg' ?>" alt="Profile Picture">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" name="Submit" value="Upload">
                    </form>
                </div>
            </section>
        </section>
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
            <?php $db = getDatabaseConnection();
            
            if(!User::isCustomer($db, $_SESSION["username"])) { ?>
                <a class="menu_option" href="profile.php?page=myRestaurants">
                <span class="material-symbols-outlined">restaurant</span>
                    <p>My Restaurants</p>
                </a>
            <?php
            }
            ?>
        </nav>
        
        <?php $page = $_GET['page'];
        if ($page === 'account') {
            show_profile();
        }
        else if ($page === 'myRestaurants' && !User::isCustomer($db, $_SESSION["username"])) {
            show_restaurants();
        }
        else if ($page === 'favorites') {
            show_favorites();
        }
        ?>

    </article>

    </main>

    <?php show_footer(); ?>

    </body>
</html>