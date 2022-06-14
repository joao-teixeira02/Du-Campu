
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

function print_order_for_owner(Order $order){
    $db = getDatabaseConnection();
    $restaurant = $order->getRestaurant($db);
    ?>
    <article class="order">
        <header>
            <h2><?php echo $restaurant->name ?></h2>
        </header>
        <main>
            <form action="/action/action_change_order_state.php" method="POST">
                <input type="hidden" name="order_id" value = "<?php echo $order->id; ?>">

                <span class="date"><?php echo $order->date;?></span>
                <span class="price">Total Check: <?php echo number_format($order->getTotalPrice($db),2);?>€</span>
                <span class="state">State: <select onChange="this.form.submit()"  name= "state_id" >
                    <?php
                        foreach(State::getStatus($db) as $state ){
                            echo '<option value="'.$state->id.'"';
                            if($order->state_id === $state->id){
                                echo ' selected ';
                            }

                            echo  '>'. $state->name . '</option>';
                        }
                        ?>
                        </select >
                        </span>
                <span class="details" data-id_order='<?php echo $order->id;?>' onclick="open_details_popup(this)" >See details</span>
            </form>
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
            <span id="userName">Customer: Joao Maria</span>
            <span id="address">Address: Rua dos pintainhos</span>
            
            
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
    
    $restaurants_selected = Owner::getRestaurants($db,  $session->getUserId());
    $restaurants_selected_name = 'all';
    $restaurants_owner = $restaurants_selected;

    if(isset($_GET['restaurant']) && is_numeric($_GET['restaurant'])){
        $restaurant_id = intval($_GET['restaurant']);
        foreach($restaurants_owner as $restaurant){
            if($restaurant->id === $restaurant_id){
                $restaurants_selected = array();
                $restaurants_selected[] = $restaurant;
                $restaurants_selected_name = $restaurant_id;
                break;
            }
        }
    }


    
    
    foreach($states as $state){
        foreach($restaurants_selected as $restaurant){
            $this_orders = Order::getOrdersFromRestaurantWithState($db, $state->id, $restaurant->id);
            if(isset($orders_by_state[$state->id]))
                $orders_by_state[$state->id] = array_merge($orders_by_state[$state->id], $this_orders );
            else
                $orders_by_state[$state->id] = $this_orders ;
        }
        
    }

    foreach($states as $state){
        if(isset($orders_by_state[$state->id])){
            // ordernar por datas
            usort($orders_by_state[$state->id], 
                function(Order $first, Order $second){
                    return strtolower($first->date) < strtolower($second->date);
                });
        }
    
    }

    
?>

    <article class="page">
        <form action="" type="GET">
            <input type="hidden" name="page" value="restaurantOrders">
            Restaurant: 
            <select onChange="this.form.submit()" name='restaurant'>
                <option value="all" <?php 
                        if(restaurants_selected_name==="all"){
                            echo 'selected';
                        } ?> >All</option>
                <?php
                foreach($restaurants_owner as $restaurant){
                    if($restaurants_selected_name === $restaurant->id){
                        echo '<option selected value="'.$restaurant->id.'"> '.$restaurant->name.'</option>';
                    }else{
                        echo '<option value="'.$restaurant->id.'"> '.$restaurant->name.'</option>';
                    }
                }
                ?>
            </select>
        </form>
        <article id="active_orders_owner" >

                <header>
                    <h1>Active Orders</h1>
                    
                </header>

                <main>
                    <?php
                        foreach($states as $state){
                            if($state->name !== 'Delivered'){
                            
                            echo '<section id="'. $state->name .'"> ' .  '<h1>'. $state->name . '</h1>';
                            ?>
                            
                            <ul>
                                <?php
                                foreach($orders_by_state[$state->id] as $order){
                                    print_order_for_owner($order);
                                }

                                ?>
                            </ul>
                            </section>
                            <?php
                            }

                        }
            

                    ?>
                            <section>
                        
                        </section>
                            
                        </div>

                            
                        
                </main>
        </article>


        <article id="historico">
            <header>
                <h1>Order History</h1>
            </header>

            <main>

                    <?php
                    
                    $orders = $orders_by_state[4];
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

?>