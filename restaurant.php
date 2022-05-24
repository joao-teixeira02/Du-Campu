<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/database/restaurant.class.php');
    require_once(__DIR__ . '/database/dish.class.php');
    require_once(__DIR__ . '/database/connection.db.php');
    

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

    function show_dishes(int $id) {?>

        <?php

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
                        <figure class="comida" clickable onclick="open_add_order_popup(this);" 
                            data-dish_id="<?php echo($dish->id)?>"
                            data-dish_name="<?php echo($dish->getName())?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id))?>"
                            data-dish_price="<?php echo($dish->getPrice())?>"   >
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

    
    function create_add_order(){
        ?>
        <div class = "background_filter">

        </div>

        <article id="add_order">
            <header>
                <img id="close" clickable width="50px" height="50px" src="images/close.png" />
                <img id="img_order" width="100px" height="100px" src="" />
            </header>
            <main>
                <h1 id="dish_name">Chicken Nuggets</h1>
                <h2 id="dish_price">2.94€</h2>

                <form id="pedido_info" action="/action/action_add_dish_cart.php" method="get">
                    <div class="select_quantity">
                        <img id="minus_dish" clickable src="images/minus_light.png" width="50px" height="50px" alt="minus one dish" />
                        <span id="quantity">1</span>
                        <input id="quantity_input" name="dish_quantity" type = "hidden" value="1" />
                        <input id="id_dish_input" name="id_dish" type = "hidden" value="1" />
                        <img id="add_dish" clickable src="images/plus_light.png" width="50px" height="50px" alt="plus one dish" />
                    </div>
                    
                    <button clickable type="submit" id="add_cart" > Add to order</button>
                </form>
            </main>

        </article>

        <?php

    }

        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <script type="text/javascript" src="js/cart.js" defer></script>

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

        </article>
    </main>


    <?php 
    create_add_order();
    
    show_footer(); 
    ?>
    </body>
</html>