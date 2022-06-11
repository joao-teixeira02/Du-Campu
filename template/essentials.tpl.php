<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/cart.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/category.class.php');

    function show_header_menu(){
        $session = new Session();
        $search_text = "";
        if(isset($_GET["s"])) {
            $search_text = htmlentities($_GET["s"]);
        }

        ?>

    <header class="menu">
        <nav>
            <input type="checkbox" class="toggle" id="drop">
            
            <a href = "index.php"> <img src = "images/logo.png" id= "logo"> </a>
            <div class = "nav-links">
                <ul>
                    <li id="profile_list_item"> 
                        <label for="profile"> 
                            <img clickable src="images/profile.png" id = "profileIcon"
                                onmouseover="this.src = 'images/profileHoover.png'"  onmouseout="this.src = 'images/profile.png'">
                        </label>
                    
                        <ul id="profile_navbar">
                            <li> <a href = "login.php">LOGIN</a> </li>
                            <li> <a href = "register.php">REGISTER</a> </li>
                        </ul>
                    </li>
                    <li id="cart_list"> 
                        <input type="checkbox" id="cart"/>
                        <label for="cart"  onclick="show_cart()" > <img clickable src="images/cart1.png" alt="Cart" id = "cartIcon"
                        onmouseover="this.src = 'images/cart1Hoover.png'"  onmouseout="this.src = 'images/cart1.png'"></label>
                    </li>
                    <li> <a href ="restaurants.php" id = "restaurantIcon" >RESTAURANTS</a></li>
                </ul>
            </div>

            <div class = "nav-links-devices">
                <ul>
                    <li id="profile_list_item"> 
                        <a href ="profile.php" >PROFILE</a>
                        <ul id="profile_navbar">
                            <li> <a href = "login.php">LOGIN</a> </li>
                            <li> <a href = "register.php">REGISTER</a> </li>
                        </ul>
                    </li>
                    <li> <a href ="restaurants.php" >RESTAURANTS</a></li>
                </ul>
            </div>
            
            
            <label for="drop" class="toggle" id='main-toggle'>
                
            <span class="material-symbols-outlined">menu</span></label>
        </nav>
    </header>


<?php 

    show_cart();


}

function show_footer(){?>

<footer class="pageFooter">

    <div class = information>
        <div class = "box">
            <figure>
                <a href = "index.php"> <img src = "images/logo.png"> </a>
            </figure>
        </div>

        <div class="box">
            <h2>WEBSITE DEVELOPERS</h2>
            <p>Afonso Baldo</p>
            <p>Inês Cardoso</p>
            <p>João Teixeira</p>
        </div>

        <div class="box">
            <h2>FOLLOW US</h2>
        </figure>
                <a href = "https://www.instagram.com/world_record_egg/" class ="socialLogo"> <img src = "images/logosSocialMedia.png"></a>
        </figure>
        </div> 

        </div>

    <div class = "copyright">
        <p>&copy; Du'Campu <b>LTW 2021/2022</b> - All Rights Reserved</p>
    </div>

</footer>


<?php } 





function show_restaurant_category($selected = array()){ ?>

    <section class= "categories" >
    <p><h3>Category</h3></p>

    <?php 
        $db = getDatabaseConnection();

        foreach(Category::getCategories($db) as $category ){
            if(in_array($category->name, $selected)){
                echo '<input type="checkbox" checked id="'.$category->id.'" name="'.$category->name.'" > ';
            }else{
                echo '<input type="checkbox" id="'.$category->id.'" name="'.$category->name.'" > ';
            }
            ?>
            <label for="<?php echo ($category->id);?>" >
            <?php echo ($category->name);?></label> 
            <br>
            <?php 
        }
    ?>
    </section>

<?php 
}


function show_price_range_checkbox(){
    ?>

        <section class = "price-range">
            <p><h3>Price range</h3></p> 
            <input type="checkbox" id="euro" name="classification" value="1"> 
            <label for="euro" > <img clickable src="images/euro.png" id= "euroo" width="47px" height="40px" alt="euro" ></label>
            <input type="checkbox" id="doiseuro" name="classification" value="2"> 
            <label for="doiseuro" > <img clickable src="images/2euro.png" id= "doiseuroo" width="50px" height="40px" alt="2euro"></label>
            <input type="checkbox" id="treseuro" name="classification" value="3"> 
            <label for="treseuro" > <img clickable src="images/3euro.png" id= "treseuroo" width="55px" height="40px" alt="3euro"></label>
        </section>
    
    <?php

}


function show_price_range_radio(int $price = 0){
    ?>
        <section class = "price-range">
            <p><h3>Price range</h3></p> 
            <input type="radio" id="euro" name="classification" value="1" <?php if ($price === 1) {echo('checked = "checked"');} ?>> 
            <label for="euro" > <img clickable src="images/euro.png" id= "euroo" width="47px" height="40px" alt="euro" ></label>
            <input type="radio" id="doiseuro" name="classification" value="2" <?php if ($price === 2) {echo('checked = "checked"');} ?>> 
            <label for="doiseuro" > <img clickable src="images/2euro.png" id= "doiseuroo" width="50px" height="40px" alt="2euro"></label>
            <input type="radio" id="treseuro" name="classification" value="3" <?php if ($price === 3) {echo('checked = "checked"');} ?>> 
            <label for="treseuro" > <img clickable src="images/3euro.png" id= "treseuroo" width="55px" height="40px" alt="3euro"></label>
        </section>
    
    <?php

}

?>




