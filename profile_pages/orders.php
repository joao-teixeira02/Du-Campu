
<?php

require_once(__DIR__ . '/../database/owner.class.php');


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
            
            
            </table>
            

        </main>

    </article>

    <?php

}


function show_owner_orders(){


    global $session;

    $db = getDatabaseConnection();
    $states = State::getStatus($db); 
    $nStates = count($states)-1; 

    
    $orders_by_state = array();

    $restaurants_owner = Owner::getRestaurants($db,  $session->getUserId());

    
    
    foreach($states as $state){
        foreach($restaurants_owner as $restaurant){
            $this_orders = Order::getOrdersFromRestaurantWithState($db, $state->id, $restaurant->id);
            if(isset($orders_by_state[$state->id]))
                $orders_by_state[$state->id] = array_merge($orders_by_state[$state->id], $this_orders );
            else
                $orders_by_state[$state->id] = $this_orders ;
        }
        
    }

    foreach($states as $state){
        if(isset($orders_by_state[$state->id])){
            usort($orders_by_state[$state->id], 
                function(Order $first, Order $second){
                    return strtolower($first->date) < strtolower($second->date);
                });
        }
    
    }

    
?>

    <article class="page">
        
        <article id="active_orders_owner" >
                <header>
                    <h1>Active Orders</h1>
                </header>

                <main>
                        <table>
                            <colgroup> 
                                <col <?php echo 'span="' . $nStates .'"  width="' . 100.0/$nStates .'%"' ?> >

                            </colgroup>
                            <tr>
                                <?php
                                
                                foreach($states as $state){
                                    if($state->name !== "Delivered" ){
                                        echo '<th>'. $state->name . '</th>';
                                    }
                                }
                                ?>
                            </tr>
                            
                            <?php
                            $adicionou = true;
                            $row_id = 0;
                            while($adicionou){
                                $adicionou = false;
                                
                                echo '<tr>';

                                foreach($states as $state){
                                    if($state->name !== "Delivered" ){
                                        $order = $orders_by_state[$state->id][$row_id];
                                        echo '<td>';
                                        if($order!==null){
                                            print_order($order);
                                            $adicionou = true;
                                        }
                                        echo '</td>';
                                    }
                                }
                                
                                echo '</tr>';
                                $row_id++;

                            }


                            ?>
                            
                        </table>
                        
                </main>
        </article>

    </article>



    <?php

}

?>