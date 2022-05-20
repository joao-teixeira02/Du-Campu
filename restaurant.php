<?php
    declare(strict_types = 1);

    require_once('template/essentials.tpl.php');
    require_once('database/restaurant.class.php');
    require_once('database/dish.class.php');
    require_once('database/connection.db.php');
    

    function show_dishes_types(int $id){ ?>

            <ul>
                <?php 
                    $types = array();
                    $db = getDatabaseConnection();

                    foreach(Restaurant::getDishes($db, $id) as $dish ){
                        $types[] = $dish->getType($db);
                    }
                    
                    foreach( array_unique($types) as $type){
                        ?>

                        <li>
                            <a href="#<?php echo ($type);?>"><?php echo ($type);?></a>
                        </li>

                        <?php
                    }
                ?>

            </ul>

        <?php

    }

    function show_restaurant_header(int $id){ ?>

        <?php 
            $db = getDatabaseConnection();
            $restaurant = Restaurant::getRestaurant($db, $id);
        ?>

        <img id="capaRestaurante" alt="Imagem do Restaurante" src="<?php echo ($restaurant->getPhoto($db, $id)); ?>">
        
        <header>
            <h1>
                <?php echo($restaurant->getName()); ?>
            </h1>
            <p id="classificao"><?php echo ($restaurant->calcRating($db, $id));?>
            <?php
                $categories = Restaurant::getCategory($db, $id);
                foreach($categories as $category){
                    echo (" • ");
                    echo ($category);
                }
            ?>
            </p>
            <p id="tempo">5 - 15 min</p>
        </header>
        <?php
    }

    function show_dishes(int $id) {

            $types = array();
            $db = getDatabaseConnection();
            $dishes = Restaurant::getDishes($db, $id);

            foreach($dishes as $dish){
                $types[] = $dish->getType($db);
            }
            foreach(array_unique($types) as $type){ ?>
                <section class="dishType" id="<?php echo ($type);?>">
                <h3><?php echo ($type);?></h3>
                <ul>
                <?php 
                foreach($dishes as $dish){ 
                    if ($dish->getType($db) === $type) { ?>
                        <li>
                        <figure class="comida" id="comida1">
                            <img src="<?php echo($dish->getPhoto($db, $id)); ?>" alt="<?php echo($dish->getName()); ?>" width="200px" height="200px" />
                            <figcaption> <?php echo($dish->getName()); ?> </figcaption>
                            <p class="preco"><?php echo($dish->getPrice()); ?> &nbsp;€</p>
                        </figure>
                        </li>
                <?php
                }
            }
            ?>
                </ul>
            </section>
            <?php

            }

    }

    function show_reviews(int $id){

        $db = getDatabaseConnection();
        $reviews = Restaurant::getReviews($db, $id);

        foreach($reviews as $review){ ?>
            <section class = "review">
            <p class="reviewUsername"><?php echo($review->getUsername($db)); ?></p>
            <p class="review"><?php echo($review->review); ?></p>
            <p class="points"><?php echo($review->points); ?></p>
            </section>
        <?php
        }
    }
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    
    <main>
        

        <article class="restaurant-page">

        <?php show_restaurant_header(1); ?>
            
            <main>

                <nav class="menuRestaurante">
                    <?php show_dishes_types(1); ?>

                </nav>

                <section id="listaPratos">

                    <?php show_dishes(1); ?>

                </section>

            </main>

            <section class="reviews">
                <?php show_reviews(1); ?>
            </section>

        </article>

        <form>
            <input class="input" type="text" placeholder="Write your review here" name="r" id="review_input">
            <input class="input" type="number" step="0.01" placeholder="Points from 0 to 5" name="p" id="points_input">
            <input formaction="action_review.php" formmethod="get" type="submit" class="white_button" value="Publish">
        </form>

        <form>
            <input class="input" type="text" placeholder="Dish name" name="n" id="dish_input">
            <input class="input" type="number" step="0.01" placeholder="Price" name="p" id="price_input">
            <input class="input" type="text" placeholder="Dish type" name="t" id="type_input">
            
            <input formaction="action_add_dish.php" formmethod="get" type="submit" class="white_button" value="Insert">
        </form>

        <form>
            <input class="input" type="text" placeholder="Restaurant name" name="n" id="restaurant_input">
            <input class="input" type="text" placeholder="Address" name="a" id="address_input">
            <input class="input" type="text" placeholder="Categories separated by comma" name="c" id="categories_input">
            
            <input formaction="action_add_restaurant.php" formmethod="get" type="submit" class="white_button" value="Insert">
        </form>

    </main>


    <?php show_footer(); ?>
    </body>
</html>