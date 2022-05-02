<?php
    declare(strict_types = 1);

    require_once('template/essentials.tpl.php');
    require_once('template/essentials.tpl.php');
    require_once('database/restaurant.class.php');
    require_once('database/connection.db.php');
    

    function show_dishes_types(int $id){ ?>

            <ul>
                <?php 
                    $types = array();
                    $db = getDatabaseConnection();

                    
                    print_r($types);
                    
                    foreach( array_unique($types) as $type){
                        ?>

                        <li>
                            <a href="#<?php echo ($type);?>"><?php echo ($type);?></a>
                        </li>

                        <?php
                    }
                ?>

            </ul>

        <?php

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/position.css">
        <title>Du'Campu</title>
    </head>
    <body>

    <?php show_header_menu(); ?>

    
    <main>
        

        <article class="restaurant-page">
            <img id="capaRestaurante" alt="Imagem do Restaurante O Forno do Leitão do Zé" src="images/restaurant1/capa.jpg">
                
            <header>
                <h1>O Forno do Leitão do Zé (Mercado Bom Sucesso)</h1>
                <p id="classificao">4.7 • Portuguesa • Carne</p>
                <p id="tempo">5 - 15 min</p>
            </header>

            <main>

            <nav class="menuRestaurante">
                    <?php show_dishes_types(1); ?>

                </nav>

                <section id="listaPratos">


                    <section class="dishType" id="Leitao">
                        <h3>Leitão</h3>
                        <ul >
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato1.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Mini-Leitão </figcaption>
                                    <p class="preco">5,90&nbsp;€</p>
                                </figure>
                            </li>
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato2.jpeg" alt="Sandes de Leitão com Batata" width="200px" height="200px" />
                                    <figcaption> Sandes de Leitão c/ Batata </figcaption>
                                    <p class="preco">8,45&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>
                        </ul>
                    </section>

                    <section class="dishType" id="Vinhos">
                        <h3>Vinhos</h3>
                        <ul >
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato1.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Mini-Leitão </figcaption>
                                    <p class="preco">5,90&nbsp;€</p>
                                </figure>
                            </li>
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato2.jpeg" alt="Sandes de Leitão com Batata" width="200px" height="200px" />
                                    <figcaption> Sandes de Leitão c/ Batata </figcaption>
                                    <p class="preco">8,45&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>

                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>
                            <li>
                                <figure class="comida" id="comida1">
                                    <img src="images/restaurant1/pratos/prato3.jpeg" alt="Mini-Leitão" width="200px" height="200px" />
                                    <figcaption> Batata Frita 35gr </figcaption>
                                    <p class="preco">0,95&nbsp;€</p>
                                </figure>
                            </li>
                        </ul>
                    </section>
                        
                </section>

            </main>

        </article>
    </main>


    <?php show_footer(); ?>
    </body>
</html>