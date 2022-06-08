
<?php

require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../database/connection.db.php');


function show_restaurant_category(){ ?>

    <section class= "categories" >
    <p><h3>Category</h3></p>
    <?php 
        $db = getDatabaseConnection();

        foreach(Category::getCategories($db) as $category ){
            ?>
            <input type="checkbox" id="<?php echo ($category->id);?>"  
            name="<?php echo ($category->name);?>" > 
            <label for="<?php echo ($category->id);?>" >
            <?php echo ($category->name);?></label> 
            <br>
            <?php 
        }
    ?>
    </section>

<?php 
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

    <article class= "addRestaurant">
        <h2> Add restaurants </h2>

        <form>
            <fieldset>
                
                <?php
                    show_restaurant_category();
                ?>
            
                <div>

                    <div id="photo_field">
                        <form action="/action/action_profile.php" method="post" enctype="multipart/form-data">
                            <label>Photo</label>
                            <img src="" id="photo" alt="Restaurante image" width="100%" height="200px"/>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </form>
                    </div>
            

                    <label for="newRestaurantName" > Restaurant Name </label>
                    <input type="text" class="attr" name="n" id="newRestaurantName" placeholder="Restaurant Name"/>

                    <label for="address" > Address </label>
                    <input type="text" class="attr" id="address" placeholder="Address"/>

                    <section class = "price-range">
                            <p><h3>Price range</h3></p> 
                                <input type="checkbox" id="euro" name="classification" value="1"> 
                                <label for="euro" > <img clickable src="images/euro.png" id= "euroo" width="47px" height="40px" alt="euro" ></label>
                                <input type="checkbox" id="doiseuro" name="classification" value="2"> 
                                <label for="doiseuro" > <img clickable src="images/2euro.png" id= "doiseuroo" width="50px" height="40px" alt="2euro"></label>
                                <input type="checkbox" id="treseuro" name="classification" value="3"> 
                                <label for="treseuro" > <img clickable src="images/3euro.png" id= "treseuroo" width="55px" height="40px" alt="3euro"></label>
                    </section>

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