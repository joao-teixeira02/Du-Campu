<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/cart.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');

    function show_header_menu(){
        $session = new Session();
        $search_text = "";
        if(isset($_GET["s"])) {
            $search_text = htmlentities($_GET["s"]);
        }

        ?>

    <header class="menu">
        <nav>
            <label for="drop" class="toggle" id='main-toggle'><span class="nav-icon"></span></label>
            <input type="checkbox" id="drop">
            <a href = "index.php"> <img src = "images/logo.png" id= "logo"> </a>
            <div class = "nav-links">
                <ul>
                    <li> 
                        <a href ="profile.php" id="profile"></a>
                        <label for="profile"> <img clickable src="images/profile.png" id = "profileIcon"
                        onmouseover="this.src = 'images/profileHoover.png'"  onmouseout="this.src = 'images/profile.png'"></label>></label>
                    </li>
                    <li> 
                        <input type="checkbox" id="cart"/>
                        <label for="cart"  onclick="show_cart()" > <img clickable src="images/cart1.png" alt="Cart" id = "cartIcon"
                        onmouseover="this.src = 'images/cart1Hoover.png'"  onmouseout="this.src = 'images/cart1.png'"></label>
                    </li>
                    <li> <a href ="restaurants.php" id = "restaurantIcon" >RESTAURANTS</a></li>
                </ul>
            </div>
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


<?php } ?>

