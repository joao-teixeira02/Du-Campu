<?php


    function show_cart(){
        ?>
        <article id="cart_box">
            <header>
            <img clickable class="cross" src="images/close.png" onclick="close_cart()"/>
            </header>

            <main>
                <!--
                <div id="empty_cart">
                    <img id = "empty_cart_image" src = "images/cart2.png" width="100px" height="100px" alt="empty cart">
                    <p>Add items from a restaurant to start a new cart<p>
                </div>
                -->
                <ul id="list_cart">
                   
                    <?php
                        for($j = 1; $j<=4; $j++){
                            $checkbox_id = "cart_restaurant_".$j;
                            ?>
                            <li>
                                <input type="checkbox"  id="<?php echo($checkbox_id);?>"/>
                                <label for="<?php echo($checkbox_id);?>">
                                    <img clickable src="images/arrow_down.png" class="cart_arrow" width= "10px" height= "10px"/><h3>Restaurante da Laurinda <?php echo($j);?></h3>
                                </label>

                                <ul class="orders_list">
                                    <li>
                                    <img class="red_cross" clickable src="images/red_cross.png" width="10px" height="10px" alt="remove item"/>
                                    <select>
                                        <?php
                                        for($i=1; $i <= 99;$i++){
                                            echo("<option value=$i>$i</option>");
                                        }
                                        ?>
                                    </select>
                                    
                                    <span>Pedido 1</span> <span class="cost">15€</span>
                                    </li>
                                    
                                    <li>
                                        <img class="red_cross" clickable src="images/red_cross.png" width="10px" height="10px" alt="remove item"/>
                                        <select>
                                            <?php
                                            for($i=1; $i <= 99;$i++){
                                                echo("<option value=$i>$i</option>");
                                            }
                                            ?>
                                        </select>
                                        <span>Pedido 2</span> <span class="cost">10€</span>
                                    </li>
                                    
                                    <li>
                                        <img class="red_cross" clickable src="images/red_cross.png" width="10px" height="10px" alt="remove item"/>
                                        <select>
                                            <?php
                                            for($i=1; $i <= 99;$i++){
                                                echo("<option value=$i>$i</option>");
                                            }
                                            ?>
                                        </select>
                                        <span>Pedido 3</span> <span class="cost">5€</span>
                                    </li>
                                    
                                    <li>
                                        <img class="red_cross" clickable src="images/red_cross.png" width="10px" height="10px" alt="remove item"/>
                                        <select>
                                            <?php
                                            for($i=1; $i <= 99;$i++){
                                                echo("<option value=$i>$i</option>");
                                            }
                                            ?>
                                        </select>
                                        <span>Pedido 4</span> <span class="cost">7€</span>
                                    </li>
                                    
                                </ul>
                                
                            </li>


                            <?php


                        }


                    ?>
                   
                </ul>
                
            
            </main>

            <button id = "check-in"> Check-in  2000 €</button>


        </article>

<?php
    }

?>
