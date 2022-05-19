<?php


    function show_cart(){
        ?>
        <article id="cart_box">
            <header>
            <img clickable class="cross" src="images/close.png" onclick="close_cart()"/>
            </header>

            <main>
                <div id="empty_cart">
                    <img id = "empty_cart_image" src = "images/cart2.png" width="100px" height="100px" alt="empty cart">
                    <p>Add items from a restaurant to start a new cart<p>
                </div>
                

            </main>


        </article>

<?php
    }

?>
