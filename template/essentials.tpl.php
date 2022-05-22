<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/cart.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');

    function show_header_menu(){
        $session = new Session();
    
        ?>

    <header class="menu">
        <nav>
            <a href = "index.php"> <img src = "images/logo.png"> </a>
            <div class = "nav-links">
                <ul>
                    <li> <a href ="index.php">HOME</a></li>
                    <li> <a href ="restaurants.php">RESTAURANTS</a></li>
                    
                    <li> <a href ="login.php"><?php echo($session->isLogged()?"PROFILE": "LOGIN"); ?></a></li>
                    <li> 
                        <input type="checkbox" id="cart"/>
                        <label for="cart" onclick="show_cart()" > <img clickable src="images/cart1.png" width="20px" height="20px" alt="Cart"></label>
                    </li>
                    <li> 
                        <input type="checkbox" id="lupa"/>
                        <input type="search" name="search" class="search" placeholder="Search">
                        <label for="lupa" > <img clickable src="images/lupa.png" width="20px" height="20px" alt="Lupa"></label>
                    </li>
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

