<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/database/restaurant.class.php');
    require_once(__DIR__ . '/database/dish.class.php');
    require_once(__DIR__ . '/database/connection.db.php');
    require_once(__DIR__ . '/database/user.class.php');
    require_once(__DIR__ . '/utils/session.php');
    require_once(__DIR__ . '/template/restaurant.tpl.php');


    $session = new Session();
    
    if(!isset($_GET['id'])){
        echo "Error restaurant id not found";
        exit(0);
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
            if ($session->isLogged() && $session->getUserId() !== $restaurant->owner_id) { ?>
                <img id="likeRestaurant" width="10px" height="10px" src="" data-restaurant_id="<?php echo($id); ?>"/>
            <?php
            }
        ?>
        
        <header>
            <h1>
                <?php echo($restaurant->getName()); 
                if (!User::isCustomer($db, $session->getUsername()) && $session->getUserId() === $restaurant->owner_id) {
                ?>
                <input type="image" class="editButton" src="images/editIcon.png" onclick="open_edit_restaurant_popup(this)"
                data-restaurant_id="<?php echo($restaurant->id); ?>"
                data-restaurant_name="<?php echo($restaurant->name); ?>"
                data-restaurant_address="<?php echo($restaurant->address); ?>"
                data-restaurant_price="<?php echo($restaurant->price); ?>"
                data-restaurant_photo="<?php echo($restaurant->getPhoto($db, $restaurant->id)); ?>"
                data-restaurant_categories="<?php echo($restaurant->getCategory($db, $restaurant->id)); ?>"
                />
                <?php
                }
                ?>
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
            $restaurant = Restaurant::getRestaurant($db, $id);
            
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
                        <?php 
                            if ($session->isLogged()) { 
                        ?>
                            <figure class="comida" clickable onclick="<?php if ($session->getUserId() !== $restaurant->owner_id && $session->isLogged()) {
                                    echo ('open_add_order_popup_favorite(this)');
                            }?>" 
                            data-dish_id="<?php echo($dish->id)?>"
                            data-dish_name="<?php echo($dish->getName())?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id))?>"
                            data-dish_price="<?php echo($dish->getPrice())?>"  >
                            <div class = "photoContainer">
                            <img src="<?php echo($dish->getPhoto($db, $dish->id)); ?>" alt="<?php echo($dish->getName()); ?>" width="200px" height="200px" />
                            <?php 
                            if ($session->getUserId() !== $restaurant->owner_id) {
                            ?>
                            <img id="heart_favorite" src="<?php 
                                
                                if ($dish->isFavDish($db, $user->id)) {
                                    echo "images/heart.png";
                                }else{
                                    echo "images/heartNotSelected.png";
                                }
                            ?>"  />
                            <?php
                            }
                            ?>
                             </div>
                            <figcaption> <?php echo($dish->getName()); ?> </figcaption>
                            <p class="preco"><?php echo($dish->getPrice()); ?> &nbsp;€</p>

                            <?php 
                            if (!User::isCustomer($db, $session->getUsername()) && $session->getUserId() === $restaurant->owner_id) {
                            ?>
                            <input type="image" class="redCross" src="images/red_cross.png" onclick="location.href='/action/action_remove_dish.php?id=<?php echo($dish->id); ?>'" />
                            <input type="image" class="editDishButton" src="images/editIcon.png" clickable onclick="open_edit_dish_popup(this)"
                            data-dish_id="<?php echo($dish->id)?>"
                            data-dish_name="<?php echo($dish->getName())?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id))?>"
                            data-dish_price="<?php echo($dish->getPrice())?>"
                            data-dish_type="<?php echo ($type); ?>">
                            <?php
                            }
                            ?>
                            
                        </figure>
                        <?php 
                        }
                        else { ?>
                            <figure class="comida" clickable onclick=
                            <?php 
                            if ($session->getUserId() !== $restaurant->owner_id) {
                                echo('open_add_order_popup(this)');
                            }
                            ?>
                            data-dish_id="<?php echo($dish->id); ?>"
                            data-dish_name="<?php echo($dish->getName()); ?>"
                            data-dish_photo="<?php echo($dish->getPhoto($db, $id)); ?>"
                            data-dish_price="<?php echo($dish->getPrice()); ?>" >
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
                <li>
                <?php 
                if (!User::isCustomer($db, $session->getUsername()) && $session->getUserId() === $restaurant->owner_id) {
                ?>
                <figure class="addDish" clickable onclick="open_add_dish_popup(this);"
                    data-dish_type="<?php echo($type); ?>"
                    data-dish_restaurant_id="<?php echo($id); ?>">
                    <img src="images/plusJoao1.png" id="addDishImage" width="100px" height="100px" />
                <figcaption>Add New Dish</figcaption>
                </figure>
                <?php
                }
                ?>
                </li>
                </ul>

            </section>
            <?php

            }

            if (!User::isCustomer($db, $session->getUsername()) && $session->getUserId() === $restaurant->owner_id) {
            ?>

            <figure class="addType" clickable onclick="open_add_type_popup(this);"
            data-dish_restaurant_id="<?php echo($id); ?>">
                <img src="images/plusJoao1.png" id="addTypeImage" width="100px" height="100px" />
                <figcaption>Add New Dish</figcaption>
            </figure>

            <?php
            }
    }

    function create_add_dish_and_type_popup() { ?>

    <article id="addDishType" class="UseInputStyle full_window_popup">
            <header>
                <img id="close" clickable width="50px" height="50px" src="images/close.png" />
            </header>
            <main>
                <form id="dish_info" action="/action/action_add_dish_type.php" method="post">
                    <input id="id" name="dish_restaurant_id" type = "hidden" value="" />
                    <div id="image-container">
                        <img id="img_dish" width="100px" height="100px" src="images/photos/profile.jpg" />
                        <input type="file" name="f" id="dish_image_upload">
                    </div>
                    <h3 id="name">Dish Name</h3>
                    <input name="n" class="attr" id="dish_name" type="text" placeholder="Dish Name" required="required" />
                    <h3 id="price">Price</h3>
                    <input name="p" class="attr" id="dish_price" type="text" placeholder="Dish Price" required="required" />
                    <h3 id="type">Dish Type</h3>
                    <input name="t" class="attr" id="dish_type" type="text" placeholder="Dish Type" required="required" />
                    <button clickable type="submit" id="edit_dish" >Add Dish</button>
                </form>
            </main>
        </article>

    <?php
    }

    function create_add_dish_popup() { ?>

        <article id="addDish" class="UseInputStyle full_window_popup">
            <header>
                <img id="close" clickable width="50px" height="50px" src="images/close.png" />
            </header>
            <main>
                <form id="dish_info" action="/action/action_add_dish.php" method="post">
                    <input name="id" id="dish_restaurant_id" type="hidden" value=""/>
                    <div id="image-container">
                        <img id="img_dish" width="100px" height="100px" src="images/photos/profile.jpg" />
                        <input type="file" name="f" id="dish_image_upload">
                    </div>
                    <h3 id="name">Dish Name</h3>
                    <input name="n" class="attr" id="dish_name" type="text" placeholder="Dish Name" required="required" />
                    <h3 id="price">Price</h3>
                    <input name="p" class="attr" id="dish_price" type="text" placeholder="Dish Proce" required="required" />
                    <input name="t" id="dish_type" type="hidden" value=""/>
                    <button clickable type="submit" id="add_new_dish" >Add Dish</button>
                </form>
            </main>
        </article>

    <?php
    }

    function create_edit_restaurant_popup(int $id) { 

        $db = getDatabaseConnection();

        $restaurant = Restaurant::getRestaurant($db, $id); 
        $price = intval($restaurant->price)
        ?>

        <article id="editRestaurant" class="full_window_popup UseInputStyle">
            <header>
                <img id="close" clickable width="50px" height="50px" src="images/close.png" />
            </header>
            <main>
                <?php
                    restaurant_form('/action/action_edit_restaurant.php', $restaurant);
                ?>
            </main>
        </article>

    <?php
    }

    function create_edit_dish_popup(){ ?>

        <article id="editDish" class="UseInputStyle  full_window_popup">
            <header>
                <img id="close" clickable width="50px" height="50px" src="images/close.png" />
            </header>
            <main>
                <form id="dish_info" action="/action/action_edit_dish.php" method="post">
                    <input id="id_dish_input" name="id_dish" type = "hidden" value="" />
                    <div id="image-container">
                        <img id="img_dish" width="100px" height="100px" src="" />
                        <input type="file" name="f" id="dish_image_upload">
                    </div>
                    <h3 id="name">Dish Name</h3>
                    <input name="n" class="attr" id="dish_name" type="text" placeholder="" required="required" />
                    <h3 id="price">Price</h3>
                    <input name="p" class="attr" id="dish_price" type="text" placeholder="" required="required" />
                    <h3 id="type">Dish Type</h3>
                    <input name="t" class="attr" id="dish_type" type="text" placeholder="" required="required" />
                    <button clickable type="submit" id="edit_dish" >Edit Dish</button>
                </form>
            </main>
        </article>


    <?php
    }
 
    
    function create_add_order(){
        ?>

        <article id="add_order" class="full_window_popup">
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
        <link rel="stylesheet" href="css/input_box.css">
        <link rel="stylesheet" href="css/drawler.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0"/>
        <script type="text/javascript" src="js/cart.js" defer></script>
        <script type="text/javascript" src="js/likeButtonHeader.js" defer></script>
        <script type="text/javascript" src="js/likeButtonDish.js" defer></script>
        <script type="text/javascript" src="js/editButtonDish.js" defer></script>
        <script type="text/javascript" src="js/editButtonRestaurant.js" defer></script>
        <script type="text/javascript" src="js/addButtonDish.js" defer></script>
        <script type="text/javascript" src="js/addButtonType.js" defer></script>
        <script type="text/javascript" src="js/myRestaurant.js" defer></script>
        <script type="text/javascript" src="js/drawler.js" defer></script>

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
                <input type="checkbox" class="drawler" id="drawler_button">
                <nav class="menuRestaurante drawler_container">
                    <?php show_dishes_types($restaurant_id); ?>
                
                    <label for="drawler_button" class="drawler">
                        <img src="/images/drawler.png"/>
                    </label>
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

    <div class = "background_filter">

    </div>
    <div class="popups">
    <?php 
    create_add_order();

    create_add_dish_and_type_popup();

    create_add_dish_popup();

    create_edit_restaurant_popup($restaurant_id);

    create_edit_dish_popup();
    
    show_footer(); 
    ?>
    </div>
    </body>
</html>