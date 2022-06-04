<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/template/essentials.tpl.php');
    require_once(__DIR__ . '/utils/session.php');
    require_once(__DIR__ . '/database/user.class.php');
    require_once(__DIR__ . '/database/owner.class.php');
    require_once(__DIR__ . '/database/restaurant.class.php');

    $session = new Session();

    function show_restaurants_slider(){

        $db = getDatabaseConnection();

        $query = 'SELECT id FROM RESTAURANT';

        $stmt = $db->prepare($query);

        $stmt->execute();

        while ($id = intval($stmt->fetch()['id'])) {
            $restaurant = Restaurant::getRestaurant($db, $id); ?>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="<?php echo($restaurant->getPhoto($db, $id)); ?>" class="restaurant-thumb" alt="">
                    <input type="button" class="card-btn" value="See Restaurant" onclick="location.href='restaurant.php?id=<?php echo($id); ?>'"/>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name"><?php echo($restaurant->name); ?></h2>
                </div>
            </div>
        <?php
        }
    }
?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" href="css/mainpage.css">
    <script type="text/javascript" src="js/carrosselSliderHome.js" defer></script>
    <script type="text/javascript" src="js/home_page_search_bar.js" defer></script>
    <title>Du'Campu</title>
</head>
<body>
    <div id="header-img"> 
        <header class = "imagesHeader">
            <div class = "nav-links">
            <ul>
                <li>
                <?php 
                    if ($session->isLogged()) { ?>
                            <a href ="profile.php?page=account">PROFILE</a>
                            <?php
                        }
                        else { ?>
                            <a href ="login.php">LOGIN</a>
                            <?php
                        }
                ?>
                </li>
                <li> <a href ="restaurants.php">RESTAURANTS</a></li>
            </ul> 
        </div>        
        </header>

        <div class="searchContainer">
            <a href = "index.php"> <img src = "images/logo.png" id = "logo"> </a>
            <p> FIND THE BEST VEGETARIAN RESTAURANTS</p>
            <form class = "imagesSearch" action="/restaurants.php" method="get">
                <input type="text" name="s" placeholder = "Search vegetarian restaurants...." class = "search-box">
                <button type="submit" class = "search-btn" >Search</button>
            </form>
        </div>
    </div>
    

    <section class="restaurant"> 
        <button class="pre-btn"><img src="images/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="images/arrow.png" alt=""></button>
        <div class="restaurant-container">
            <?php show_restaurants_slider();?>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/image.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagessss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>

            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/images.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/image.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagessss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>

            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagessss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagesss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagessss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
            <div class="restaurant-card">
                <div class="restaurant-image">
                    <img src="images/imagessss.jpg" class="restaurant-thumb" alt="">
                    <button class="card-btn">See Restaurant</button>
                </div>
                <div class="restaurant-info">
                    <h2 class="restaurant-name">AM indiano bar</h2>
                </div>
            </div>
        

            

        </div>
    </section>

</body>

</html>