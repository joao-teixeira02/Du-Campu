
<?php
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
            <a href = "restaurants.php" class = "noFavs">
            <h4>Seems like you have no favorite restaurants yet. Click here to visit our restaurants page to find some!</h4> 
            </a>
            <?php
        }
        else { ?>
            <button class="pre-btn1"><img src="images/arrow.png" alt=""></button>
            <button class="nxt-btn1"><img src="images/arrow.png" alt=""></button>
            <?php
            foreach($favRestaurants as $favRestaurant) { ?>
                <div class="restaurant-cont">
                    <div class="restaurant_img">
                        <img class="thumb" alt="Imagem do Restaurante" src="<?php echo (htmlentities($favRestaurant->getPhoto($db, $favRestaurant->id))); ?>">
                        <input type="button" class="card-btn" value="See Restaurant" onclick="location.href='restaurant.php?id=<?php echo($favRestaurant->id); ?>'"/>
                    </div>
                    <h3>
                        <?php echo(htmlentities($favRestaurant->getName())); ?>
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
            <a href = "restaurants.php" class = "noFavs">
            <h4>Seems like you have no favorite dishes yet. Click here to visit our restaurants page to find some!</h4> 
            </a>
            <?php
        }
        else { ?>
            <button class="pre-btn2"><img src="images/arrow.png" alt=""></button>
            <button class="nxt-btn2"><img src="images/arrow.png" alt=""></button>
            <?php
            foreach($favDishes as $favDish) { ?>
            <div class="dish-cont">
                <div class="dish_img">
                    <img class="thumb" alt="Imagem do Prato" src="<?php echo (htmlentities($favDish->getPhoto($db, $favDish->id))); ?>">
                    <input type="button" class="card-btn" value="See Dish" onclick="location.href='restaurant.php?id=<?php echo($favDish->restaurant_id); ?>#<?php echo(htmlentities($favDish->getType($db))); ?>'"/>

                </div>
                <h3>
                    <?php echo(htmlentities($favDish->name)); ?>
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

?>