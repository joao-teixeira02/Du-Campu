<?php
    declare(strict_types = 1);

    require_once('template/essentials.tpl.php');
    require_once('database/restaurant.class.php');
    require_once('database/dish.class.php');
    require_once('database/connection.db.php');
    require_once('database/user.class.php');
    

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
                <?php
                if(isLogged()) {
                    if (!User::isCustomer($db, $_SESSION['username'])) {?>
                        <form>
                            <input class="input" type="text-area" placeholder="Write your reply here" name="t" id="reply_input">
                            <input type="hidden" name="r" value="<?php echo($review->id); ?>">
                            <input formaction="action_reply.php" formmethod="post" type="submit" class="white_button" value="Reply">
                        </form>
                <?php
                    }
                }
                ?>
            </section>
        <?php
        }
    }

    function add_review(){

        if(isLogged()) {
    ?>
        <form>
            <input class="input" type="text-area" placeholder="Write your review here" name="r" id="review_input">
            <input class="input" type="number" step="0.1" min="0" max="5" placeholder="0 to 5" name="p" id="points_input">
            <input formaction="action_review.php" formmethod="post" type="submit" class="white_button" value="Publish">
        </form>
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

        <?php 
        
        $restaurant_id = intval($_GET['id']);
        
        show_restaurant_header($restaurant_id);
        
        ?>
            
            <main>
                <nav class="menuRestaurante">
                    <?php show_dishes_types($restaurant_id); ?>
                </nav>

                <section id="listaPratos">
                    <?php show_dishes($restaurant_id); ?>
                </section>
            </main>

            <section class="reviews">
                <?php show_reviews($restaurant_id); ?>
            </section>

        </article>

        <?php add_review(); ?>

    </main>


    <?php show_footer(); ?>
    </body>
</html>