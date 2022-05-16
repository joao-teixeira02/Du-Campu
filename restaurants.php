<?php

declare(strict_types = 1);

require_once('template/essentials.tpl.php');
require_once('database/category.class.php');
require_once('database/connection.db.php');


function show_restaurant_category(){ ?>

        <section class= "categories" >
        <p><h3>Category</h3></p>
        <?php 
            $types = array();
            $db = getDatabaseConnection();

            foreach(Category::getCategories($db) as $category ){
                ?>
                <input type="checkbox" id="<?php echo ($category->id);?>"  
                name="<?php echo ($category->name);?>" > 
                <label for="<?php echo ($category->name);?>" >
                <?php echo ($category->name);?></label> 
                <br>
                <?php 
            }
        ?>
        </section>

    <?php 
}?>





<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/position.css">
    <script type="text/javascript" src="js/range.js"></script>
    <script type="text/javascript" src="js/restaurants.js" defer></script>


    <title>Du'Campu</title>
</head>

<body>

    <?php show_header_menu(); ?>

    <main class = "restaurantsListPage">   

        <h1>Explore the restaurants</h1>   
         <br>    

        <section class = "restaurantsList">                                                                              
            <section class = "filters">

                <?php show_restaurant_category(); ?>

            <br>

            <section class = "price-range">
                <p><h3>Price range</h3></p> 
                    <input type="checkbox" id="€" name="classification" value="€"> <label for="€"></label>
                    <input type="checkbox" id="€€" name="classification" value="€€"> <label for="€€"></label>
                    <input type="checkbox" id="€€€" name="classification" value="€€€"> <label for="€€€"></label>
                    <input type="checkbox" id="€€€€" name="classification" value="€€€€"> <label for="€€€€"></label>
            </section>
            
            <br>
            <br>
            <br>

            <section class = "classification">
                <p><h3>Average Score</h3></p>
                <div slider id="slider-distance">
                    <div>
                    <div inverse-left style="width:70%;"></div>
                    <div inverse-right style="width:70%;"></div>
                    <div range style="left:0%;right:0%;"></div>
                    <span thumb style="left:0%;"></span>
                    <span thumb style="left:100%;"></span>
                    <div sign style="left:0%;">
                        <span id="value">0.0</span>
                    </div>
                    <div sign style="left:100%;">
                        <span id="value">5.0</span>
                    </div>
                    </div>
                    <input type="range" value="0" max="5" min="0" step="0.1" id="rangeLeft" oninput="rangeLeft();"/>
                    <input type="range" value="5" max="5" min="0" step="0.1" id="rangeRight" oninput="rangeRight();"/>
                    </div>
            </section>

            </section>

            <section class = "orderBy">
                <h5>ORDER BY:</h5>
                <select id="sorter">
                    <option value="rating"> Rating</option>
                    <option value="price"> Price</option>
                </select>
                <input type="checkbox" id="asc"> <label for="asc"></label> <br>
                
            </section>

            <section class = "restaurants">
                <div class = "restaurantContainer" > 
                    <img src = "https://picsum.photos/150/150?" alt = "">
                    <article class = "restaurantInfo">
                        <span id = "name">Restaurante do Zé</span>
                        <span id = "address">Rua dos martelinhos 304</span>
                        <span id = "rating">rating</span>
                        <span id = "category">categoria</span>
                        <span id = "price">Intervalo de preço: € - €€ </span>
                        <button type = "button" id = "like-button" ></button>
                    </article>
                </div>

            </section>
        </section>
        
    </main>

    <?php show_footer(); ?>
</body>
</html>
