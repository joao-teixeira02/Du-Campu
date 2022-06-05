<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/database/restaurant.class.php');
    require_once(__DIR__ . '/database/dish.class.php');
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/user.class.php');
    require_once(__DIR__ . '/utils/session.php');

    $session = new Session();
    
    if(isset($_GET['s'])){    
        $search_text = $_GET['s'];
    }

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
        <?php
            global $session;
            if ($session->isLogged()) { ?>
                <img id="likeRestaurant" width="10px" height="10px" src="" data-restaurant_id="<?php echo($id); ?>"/>
            <?php
            }
        ?>
        
        <header>
            <h1>
                <?php echo($restaurant->getName()); ?>
            </h1>
            <p id="classificao"><?php echo ($restaurant->calcRating($db, $id));
                $categories = Restaurant::getCategory($db, $id);
                foreach($categories as $category){
                    echo (" • ");
                    echo ($category);
                }
                echo (" • ");
                for($i = 0; $i < $restaurant->price; $i++) {
                    echo('€');
                }
            ?>
            </p>
        </header>
        <?php
    }

    function show_dishes(int $id) {

            global $session;

            $types = array();
            $db = getDatabaseConnection();
            $dishes = Restaurant::getDishes($db, $id);
            
            $user = null;
            if ($session->isLogged()) {
                $user = User::getUser($db, $session->getUsername());
                
            }

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
                        <?php if ($session->isLogged()) { 
                            ?>
                            <figure class="comida" clickable onclick="open_add_order_popup_favorite(this);" 
                            data-dish_id="<?php echo($dish->id)?>"
                            data-dish_name="<?php echo($dish->getName())?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id))?>"
                            data-dish_price="<?php echo($dish->getPrice())?>"   >
                            <div class = "photoContainer">
                            <img src="<?php echo($dish->getPhoto($db, $id)); ?>" alt="<?php echo($dish->getName()); ?>" width="200px" height="200px" />
                            <img id="heart_favorite" src="<?php 
                                
                                if ($dish->isFavDish($db, $user->id)) {
                                    echo "images/heart.png";
                                }else{
                                    echo "images/heartNotSelected.png";
                                }
                            ?>"  />
                             </div>
                            <figcaption> <?php echo($dish->getName()); ?> </figcaption>
                            <p class="preco"><?php echo($dish->getPrice()); ?> &nbsp;€</p>
                        </figure>
                        <?php 
                        }
                        else { ?>
                            <figure class="comida" clickable onclick="open_add_order_popup(this);" 
                            data-dish_id="<?php echo($dish->id)?>"
                            data-dish_name="<?php echo($dish->getName())?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id))?>"
                            data-dish_price="<?php echo($dish->getPrice())?>"   >
                            <img src="<?php echo($dish->getPhoto($db, $id)); ?>" alt="<?php echo($dish->getName()); ?>" width="200px" height="200px" />
                            <figcaption> <?php echo($dish->getName()); ?> </figcaption>
                            <p class="preco"><?php echo($dish->getPrice()); ?> &nbsp;€</p>
                        </figure>
                        <?php 
                        }
                        ?>
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
                <?php 
                global $session;
                if ($session->isLogged()) { ?>
                    <img id="heart_favorite" width="10px" height="10px" src="" />
                <?php
                }
                ?>
                
            </header>
            <main>
                <h1 id="dish_name"></h1>
                <h2 id="dish_price"></h2>


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

        
    function show_reviews(int $id){

        global $session;

        $db = getDatabaseConnection();
        $reviews = Restaurant::getReviews($db, $id);
        foreach($reviews as $review){ 
            
            $photo = User::getUser($db, $review->getUsername($db))->getPhoto($db);
            $reply = $review->getReply($db);
            ?>
            <section class = "review">
                <img class="reviewPhoto" src = "<?php echo($photo); ?>"/>
                <div class = "basicInfo">
                    <p class="reviewUsername"><?php echo($review->getUsername($db)); ?></p>
                    <p class="date"><?php echo($review->date); ?></p>
                </div>
                <p class="reviewText"><?php echo($review->review); ?></p>
                <p class="points"><?php echo($review->points); ?></p>
                <?php
                if($session->isLogged()) {
                    if (!User::isCustomer($db, $session->getUsername()) && $session->getUserId() === Restaurant::getRestaurant($db, $id)->owner_id) {
                        if ($review->getReply($db) === null) { ?>
                        <form class = "addReply">
                            <input class="reply" type="text-area" placeholder="Write your reply here" name="t" id="reply_input" required="required">
                            <input type="hidden" name="r" value="<?php echo($review->id); ?>">
                            <input formaction="/action/action_reply.php" formmethod="post" type="submit" class="white_button" value="Reply">
                        </form>
                <?php
                        }
                        else { 
                            $owner_photo = User::getUser($db, $reply->getUsername($db))->getPhoto($db);?>
                        <section class="reply">
                            <img class="replyPhoto" src="<?php echo($owner_photo) ?>"/>
                            <div class="basicInfo">
                            <p class="replyUsername"><?php echo($reply->getUsername($db)); ?></p>
                            <p class="date"><?php echo($reply->date); ?></p>
                            </div>
                            <p class="replyText"><?php echo($reply->text); ?></p>
                        </section>
                <?php
                        }
                    }
                ?>
            </section>
        <?php
                }
        }
    }

    function add_review(int $id){

        global $session;

        if($session->isLogged()) {
            
            $db = getDatabaseConnection();
            $photo = User::getUser($db, $session->getUsername())->getPhoto($db);
    ?>
        <form class = "addReviewContainer">
            <h2>Add a review</h2>
            <input class= "addReview" type="text-area" placeholder="Write your review here" name="r" id="review_input" required="required">
            
            <img id="add_review_photo" alt="profile image" src="<?php echo $photo; ?>" />
            
                <div class = "classification">
                <input type="radio" id="star5" name="p" value="5"> <label for="star5" required="required"></label>
                <input type="radio" id="star4" name="p" value="4"> <label for="star4"></label>
                <input type="radio" id="star3" name="p" value="3"> <label for="star3"></label>
                <input type="radio" id="star2" name="p" value="2"> <label for="star2"></label>
                <input type="radio" id="star1" name="p" value="1"> <label for="star1" ></label>
                </div>
                <input type="hidden" name="r_id" value="<?php echo($id); ?>">
            <input formaction="/action/action_review.php" formmethod="post" type="submit" class="white_button" value="Publish">
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
        <link rel="stylesheet" href="css/restaurantPage.css">
        <link rel="stylesheet" href="css/position.css">
        <script type="text/javascript" src="js/cart.js" defer></script>
        <script type="text/javascript" src="js/likeButtonHeader.js" defer></script>
        <script type="text/javascript" src="js/likeButtonDish.js" defer></script>

        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    <main>

        <article class="restaurant-page">

        <?php 

        $db = getDatabaseConnection();
        
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

            <div id = "reviewsContainer">
                <section class="reviews">
                    <h1> Reviews (<?php 
                    $reviews = Restaurant::getReviews($db, $restaurant_id);
                    echo sizeof($reviews);?>)</h1>
                    <br>
                    <?php 
                    if ($session->getUserId() !== Restaurant::getRestaurant($db, $restaurant_id)->owner_id) {
                        add_review($restaurant_id); 
                    }
                    ?>

                    <?php show_reviews($restaurant_id); ?>
                </section>
            </div>

        </article>
    
        

    </main>


    <?php 
    create_add_order();
    
    show_footer(); 
    ?>
    </body>
</html>