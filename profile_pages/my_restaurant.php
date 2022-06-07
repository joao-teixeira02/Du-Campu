
<?php

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


?>