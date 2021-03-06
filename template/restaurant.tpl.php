
<?php
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../template/essentials.tpl.php');


function restaurant_form(string $action, Restaurant $restaurant = null){
    $name = '';
    $photo = '/images/restaurant/defaultRestaurantPhoto.png';
    $address = '';
    $id = '';
    $edit = false;
    $price = 0;
    $categories = array();
    $db = getDatabaseConnection();

    if($restaurant !== null){
        $name = $restaurant->name;
        $photo = $restaurant->photo;
        $address = $restaurant->address;
        $id = $restaurant->id;
        $price = intval($restaurant->price);
        $categories = Restaurant::getCategory($db, $restaurant->id);

        
        $edit = true;
    }

    ?>

    <form action="<?php echo htmlentities($action); ?>" class="restaurantForm" method="POST" enctype="multipart/form-data">
        <fieldset>
            <div>   
                <input name="id_restaurant" value="<?php echo $id; ?>" type="hidden"/>
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                <div id="photo_field">
                    <img src="<?php echo htmlentities($photo);?>" id="photo" alt="Restaurant image" width="100%" height="200px"/>
                    <input type="file" name="fileToUpload" <?php echo ($restaurant===null)?'required':'' ?> id="fileToUpload">
                </div>
        

                <label for="newRestaurantName" > Restaurant Name </label>
                <input type="text" class="attr" name="n" required id="newRestaurantName" <?php
                if($edit){
                    echo 'value = "'.htmlentities($name) .'" placeholder="'. htmlentities($name) .'"';
                }else{
                    echo ' placeholder = "Restaurant Name"';
                }
                ?>
                />
                <label for="address" > Address </label>
                <input type="text" class="attr" name="a" required id="address" <?php
                if($edit){
                    echo 'value = "'.htmlentities($address) .'" placeholder="'. htmlentities($address) .'"';
                }else{
                    echo ' placeholder = "Restaurant Address"';
                }
                ?>

                />

                <?php 
            
                    show_price_range_radio($price);
                    show_restaurant_category($categories);

                ?>
                
            </div>

            <?php
            if($edit){
                echo '<input type="submit" value="Edit Restaurant"/>';
            }else{
                echo '<input type="submit" value="Add Restaurant"/>';
            }

            ?>
        </fieldset>
    </form>

    <?php
}


?>