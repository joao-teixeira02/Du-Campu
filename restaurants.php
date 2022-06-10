<?php

declare(strict_types = 1);

require_once(__DIR__ . '/template/essentials.tpl.php');
require_once(__DIR__ . '/database/category.class.php');
require_once(__DIR__ . '/database/connection.db.php');

if($_GET['s']){    
    $search_text = $_GET['s'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/position.css">
    <link rel="stylesheet" href="css/drawler.css">
    <script type="text/javascript" src="js/likeButtonRestaurant.js"></script>
    <script type="text/javascript" src="js/range.js" defer></script>
    <script type="text/javascript" src="js/restaurants.js" defer></script>
    <script type="text/javascript" src="js/priceImageChange.js" defer></script>
    <script type="text/javascript" src="js/arrowChanger.js" defer></script>
    <script type="text/javascript" src="js/cart.js" defer></script>

    <title>Du'Campu</title>
</head>

<body>

    <?php 
        show_header_menu();     
    ?>

    <main class = "restaurantsListPage">   
        <section class = "restaurantsList">     
                
            <input type="checkbox" class="drawler" id = "drawler_button"/>                                                                   
            <section class = "filters">

                <section class = "searchBoxContainer">
                    <form action="" class ="search-bar">
                        <button type="submit"><img src="images/search.png"></button>
                        <input type="search" name="search" placeholder= "Search..." value="<?php  echo($search_text)?>">
                    </form>
                </section>    
                
                <br>
            

                <?php show_restaurant_category(); ?>

                <br>
    
                <?php
                    show_price_range_checkbox();
                ?>
                
                <br>
                <br>
                <br>
                <br>

                <section class = "classification">
                    <p><h3>Classification</h3></p> 
                    <section class = "slider">
                        <div class="min-value numberVal">
                            <span class="number"  disabled>0</span>
                        </div>   
            
                        <div class="range-slider">
                            <div class="progress"></div>
                            <input type="range" class="range-min" min="0" max="5" value="0" step="0.1">
                            <input type="range" class="range-max" min="0" max="5" value="5" step="0.1">
                        </div>
                        <div class="max-value numberVal">
                            <span class="number" disabled>5</span>
                        </div>
                    </section>
                </section>

                <label for="drawler_button" class="drawler">
                <img src="/images/2euro.png"/>
            </label>
            
            </section>
            
            

            <section class = "orderBy">
                <h5>ORDER BY:</h5>
                <select id="sorter">
                    <option value="rating"> Rating</option>
                    <option value="price"> Price</option>
                </select>
                <input type="checkbox" id="asc"> <label for="asc">
                <img clickable src="images/down.png" width="15px" height="15px" alt="asc" id="down" > <br>
                
            </section>

            <section class = "restaurants">
                

            </section>
        </section>
        
    </main>

    <?php show_footer(); ?>
</body>
</html>
