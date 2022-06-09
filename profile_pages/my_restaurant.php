
<?php

require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ .  '/../template/essentials.tpl.php');


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

    <article class="myRestaurants">

    <h2> My restaurants </h2>

       <section class="myRestaurantsList"> 
        <button class="pre-btn3"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn3"><img src="images/arrow.png" alt=""></button>

        <?php $restaurants = Owner::getRestaurants($db, $id);
        foreach($restaurants as $restaurant) {?>

            <div class="restaurant-cont">
                <div class="restaurant_img">
                        <img class="thumb" alt="Imagem do Restaurante" src="<?php echo ($restaurant->getPhoto($db, $id)); ?>">
                        <input type="button" class="card-btn" value="Edit Restaurant" onclick="location.href='restaurant.php?id=<?php echo($restaurant->id); ?>'"/>
                </div>
                    <h3>
                        <?php echo($restaurant->getName()); ?>
                    </h3>
                </div>
            </div> 
        <?php
    }
    ?>
    </section> 
    </article>

    <article class= "addRestaurant UseInputStyle">
        <h2> Add a restaurant </h2>

        <form action="/action/action_add_restaurant.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                
                <?php
                    show_restaurant_category();
                ?>
            
                <div>

                    <div id="photo_field">
                        <label>Photo</label>
                        <img src="/images/restaurant1/capa.jpg" id="photo" alt="Restaurante image" width="100%" height="200px"/>
                        <input type="file" name="fileToUpload" require id="fileToUpload">
                    </div>
            

                    <label for="newRestaurantName" > Restaurant Name </label>
                    <input type="text" class="attr" name="n" require id="newRestaurantName" placeholder="Restaurant Name"/>

                    <label for="address" > Address </label>
                    <input type="text" class="attr" name="a" require id="address" placeholder="Address"/>

                    <?php 
                    show_price_range_radio();
                    ?>

                    <input type="submit" value="Add Restaurant"/>
                </div>
            </fieldset>
        </form>
            <br>
            <br>
            <br>

    </article>
    <?php
}

?>