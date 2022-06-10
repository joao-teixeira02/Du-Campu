
<?php
    require_once(__DIR__ . '/../database/restaurant.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../template/essentials.tpl.php');


function restaurant_form(string $action, Restaurant $restaurant = null){
    $name = '';
    $photo = '/images/restaurant1/capa.jpg';
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

    <form action="<?php echo $action; ?>" class="restaurantForm" method="POST" enctype="multipart/form-data">
        <fieldset>
            <div>   
                <input name="id_restaurant" value="<?php echo $id; ?>" type="hidden"/>

                <div id="photo_field">
                    <img src="<?php echo $photo;?>" id="photo" alt="Restaurante image" width="100%" height="200px"/>
                    <input type="file" name="fileToUpload" require id="fileToUpload">
                </div>
        

                <label for="newRestaurantName" > Restaurant Name </label>
                <input type="text" class="attr" name="n" require id="newRestaurantName" <?php
                if($edit){
                    echo 'value = "'.$name .'" placeholder="'. $name .'"';
                }else{
                    echo ' placeholder = "Restaurant Name"';
                }
                ?>
                />
                <label for="address" > Address </label>
                <input type="text" class="attr" name="a" require id="address" <?php
                if($edit){
                    echo 'value = "'.$address .'" placeholder="'. $address .'"';
                }else{
                    echo ' placeholder = "Restaurant Addresss"';
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