
<?php


function print_order(Order $order){
    $db = getDatabaseConnection();
    $restaurant = $order->getRestaurant($db);
    ?>
    <article class="order">
        <header>
            <h2><?php echo $restaurant->name ?></h2>
        </header>
        <main>
            <span class="date"><?php echo $order->date;?></span>
            <span class="price">Total Check: <?php echo number_format($order->getTotalPrice($db),2);?>€</span>
            <span class="state">State: <?php echo State::getStatebyId( $db, $order->state_id)->name;?></span>
            <span class="details" data-id_order='<?php echo $order->id;?>' onclick="open_details_popup(this)" >See details</span>
        <main>
    </article>

    <?php

}

function show_orders(){
    global $session;

    $db = getDatabaseConnection();
    $states = State::getStatus($db); 
    ?>

    <article class="page">
        
    <article id="active_orders" >
            <header>
                <h1>Active Orders</h1>
            </header>

            <main>
                    <?php
                    $orders = Order::getOrderActive($db, $session->getUserId());
                    
                    ?> 

                    <ul> 

                    <?php
                    foreach($orders as $order){
                        print_order($order);
                    }

                    ?>

                    </u>
                    
            </main>
        </article>

        <article id="historico">
            <header>
                <h1>Order History</h1>
            </header>

            <main>

                    <?php
                    $delivered_state = 4;
                    $orders = Order::getOrderWithState($db, $delivered_state, $session->getUserId());
                    ?> 

                    <ul> 

                    <?php
                    foreach($orders as $order){
                        print_order($order);
                    }

                    ?>

                    </u>
                    
            </main>
        </article>

    </article>


    <?php
}

function show_order_details_popup(){
    ?>

    <div class = "background_filter">

    </div>

    <article id="popup_order_details" class="full_window_popup">

        <header>
            <img clickable class="cross" src="images/close.png" onclick="close_details_popup()">
            <h1 id="restaurant_name"> Restaurant name</h1>
            <span id="TotalPrice">20 €</span>
        </header>

        <main>
            
            
            <table>
            <tr>
                <th>Quantity</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>4</td>
                <td>Prato Muita Bom</td>
                <td>10 €</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Prato Muita MAU</td>
                <td>10 €</td>
            </tr>

            <tr>
                <td>4</td>
                <td>Prato Muita d</td>
                <td>10 €</td>
            </tr>
            </table>
            

        </main>

    </article>

    <?php

}

?>