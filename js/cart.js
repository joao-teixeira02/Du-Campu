
const cart_box = document.querySelector("#cart_box");
var desaparecerCartTimerON = false
var aparecerCartTimerON = false
var id = 0


update_cart();

function close_cart(){
    cart_box.removeAttribute("display_block");
} 

function show_cart(){
    update_cart();
    if(aparecerCartTimerON)  
        return
    
    if(desaparecerCartTimerON)  
        clearInterval(id);

    cart_box.style.opacity = 0;
    
    cart_box.setAttribute("display_block", "");
    opacity_value = 0;
    
    id = window.setInterval(aparecer, 10);
    aparecerCartTimerON = true;
    function aparecer() {
        if (cart_box.style.opacity != 1) {
            opacity_value+=0.1
            
            cart_box.style.opacity = opacity_value.toFixed(1);
            setTimeout(aparecer, 0.1)
        }else{
            aparecerCartTimerON = false;
            clearInterval(id);
        }
    }

} 

document.addEventListener("scroll", close_cart);

/* Minimizing Restaurant Orders*/

const checkbox_list = document.querySelectorAll('#list_cart input[type="checkbox"]');

for(const minimizing_checkbox of checkbox_list){
    minimizing_checkbox.addEventListener("change", (e) => {
            const this_checkbox = document.querySelector("#"+e.target.id);

            let lala = "#" + e.target.id +" ~ * .cart_arrow"; 
            
            const this_checkbox_img = document.querySelector(lala);
            if(this_checkbox.checked){
                this_checkbox_img.src = "images/arrow_up.png"
            }else{
                this_checkbox_img.src = "images/arrow_down.png"
            }
        });

}

/* get dishes from server */
async function update_cart(){
    const response = await fetch('api/api_get_cart.php')
    const cart_info = await response.json()

    const cart_info_map = new Map(Object.entries(cart_info));

    const check_in = document.querySelector("#check-in");
    const empty_cart = document.querySelector("#empty_cart");
    const main = document.querySelector('#cart_box main');

    /* Clear list_cart if exists or create one */
    let list_cart = document.querySelector('#cart_box main #list_cart');
    if(list_cart){
        list_cart.innerHTML = "";
    }else{
        list_cart = document.createElement('ul')
        list_cart.setAttribute("id", "list_cart")
    }
    
    if(cart_info_map.size == 0){
        // empty
        
        main.style.gridRow = "";
        main.style.overflowY = "";

        empty_cart.style.display = "block";
        check_in.style.display = "none";
        list_cart.style.display = "none";
        return
    }
    let total = 0

    for (const [restaurant_id, restaurant_orders] of cart_info_map) {
        const restaurant_li = document.createElement('li')

        // restaurant checkbox
        const restaurant_checkbox = document.createElement('input')
        restaurant_checkbox.setAttribute("type", "checkbox");
        restaurant_checkbox.setAttribute("id", "restaurant_checkbox"+ restaurant_id);
        restaurant_li.appendChild(restaurant_checkbox);
        // restaurant checkbox fim
        
        // restaurant checkbox label
        const restaurant_label = document.createElement('label')
        restaurant_label.setAttribute("for", "restaurant_checkbox"+restaurant_id);
            
        // img arrow
        const arrow_img = document.createElement('img')
        arrow_img.setAttribute("src", "images/arrow_down.png");
        arrow_img.setAttribute("clickable", "");
        arrow_img.classList.add("cart_arrow")
        restaurant_label.appendChild(arrow_img);
        // img arrow fim
        restaurant_label.innerHTML += '<h3>' + restaurant_orders.restaurant.name + '</h3>'
        restaurant_li.appendChild(restaurant_label);
        // restaurant checkbox label fim



        // orders_list
        const orders_list = document.createElement('ul')
        orders_list.classList.add("orders_list")

        // percorrer orders
        for(const order of  restaurant_orders.orders){
            const dish_li = document.createElement('li')

            const dish_cross = document.createElement('img')
            dish_cross.classList.add("red_cross")
            dish_cross.setAttribute("clickable", "")
            dish_cross.setAttribute("src", "images/red_cross.png")
            dish_cross.setAttribute("alt", "remove item")
            dish_cross.setAttribute("width", "10px")
            dish_cross.setAttribute("height", "10px")
            dish_cross.setAttribute("data-id", order.dish.id)
            dish_cross.addEventListener("click", removeDishEvent)

            dish_li.appendChild(dish_cross)
            const options_select = document.createElement('select')
            options_select.innerHTML = "";
            for(let i = 1; i <= 99; i++){
                options_select.innerHTML += "<option value="+i+">"+i+"</option>"
            }

            options_select.value = order.quantity
            options_select.addEventListener("change", changeDishEvent)
            options_select.setAttribute("data-id", order.dish.id)
            dish_li.appendChild(options_select)

            const dish_name = document.createElement('span')
            dish_name.innerText = order.dish.name;

            const dish_price = document.createElement('span')
            dish_price.classList.add("cost");
            dish_price.innerText = parseFloat(order.dish.price*order.quantity).toFixed(2)
            total += order.dish.price*order.quantity;

            dish_li.appendChild(dish_name);
            dish_li.appendChild(dish_price);


            orders_list.appendChild(dish_li);

        }
        restaurant_li.appendChild(orders_list);
        // orders_list fim
        

        list_cart.appendChild(restaurant_li)
    }

    
    main.appendChild(list_cart);
    main.style.gridRowStart = 2;
    main.style.gridRowSpan = 1;  
    main.style.overflowY = "scroll";  
    empty_cart.style.display = "none";
    check_in.style.display = "flex";
    check_in.innerText = 'Check-in ' + total.toFixed(2) +'€';
    
}



/* remove dishes */
function removeDishEvent(e){
    const id = e.target.getAttribute('data-id');
    fetch('action/action_add_dish_cart.php?id_dish='+id+'&dish_quantity=0').then(update_cart);
}


/* change dish quantity */
function changeDishEvent(e){
    const id = e.target.getAttribute('data-id');
    const selected_value = e.target.value;
    fetch('action/action_add_dish_cart.php?id_dish='+id+'&dish_quantity='+selected_value).then(update_cart);
}




/* add order popup*/

const add_order_popup = document.querySelector("#add_order");
const background_filter = document.querySelector(".background_filter");

if(add_order_popup){

    const close = document.querySelector("#add_order #close");
    const img_minus = document.querySelector("#add_order #minus_dish");
    const img_plus = document.querySelector("#add_order #add_dish");
    const span_quantity = document.querySelector("#add_order #quantity");
    const quantity_input = document.querySelector("#add_order #quantity_input");

    close.addEventListener('click', ()=>{
        add_order_popup.style.display = "none"
        background_filter.style.display = "none"
        
    })
    
    img_minus.addEventListener('mouseover', ()=>{img_minus.src = 'images/minus.png'})
    img_minus.addEventListener('mouseout', ()=>{ img_minus.src = 'images/minus_light.png'})
    img_minus.addEventListener('click', ()=>{ 
        let v = parseInt(span_quantity.innerText)

        if(v > 1)
            v -= 1
        else
            v=1
        span_quantity.innerText = v
        quantity_input.value = v;
        }
        
        )

    
    img_plus.addEventListener('mouseover', ()=>{img_plus.src = 'images/plus.png'})
    img_plus.addEventListener('mouseout', ()=>{ img_plus.src = 'images/plus_light.png'})
    img_plus.addEventListener('click', ()=>{ 
        console.log(span_quantity.innerText)
        let v = parseInt(span_quantity.innerText)

        if(v < 99)
            v += 1
        else
            v = 99
        span_quantity.innerText = v
        quantity_input.value = v;

        })

    
    const id_dish_input = document.querySelector("#pedido_info #id_dish_input");
    const dish_photo_element = document.querySelector("#add_order #img_order");
    const dish_name_element = document.querySelector("#add_order #dish_name");
    const dish_price_element = document.querySelector("#add_order #dish_price");
    const dish_favorite_heart = document.querySelector("#add_order #heart_favorite");

    function open_add_order_popup(e){

        const dish_id = e.getAttribute('data-dish_id')
        id_dish_input.value = dish_id;

        const dish_name = e.getAttribute('data-dish_name')
        dish_name_element.innerText = dish_name;

        const dish_photo = e.getAttribute('data-dish_photo')
        dish_photo_element.src = dish_photo;

        const dish_price = e.getAttribute('data-dish_price')
        dish_price_element.innerText = dish_price;

        quantity_input.value = 1;
        span_quantity.innerText = 1;


        
        add_order_popup.style.display = "block"
        background_filter.style.display = "block"

    }

    function open_add_order_popup_favorite(e){
        async function load_popup() {

            const response =  await fetch('/api/api_get_favorite_dishes.php')
            const favorites = await response.json()

            const dish_id = e.getAttribute('data-dish_id')
            id_dish_input.value = dish_id;

            const dish_name = e.getAttribute('data-dish_name')
            dish_name_element.innerText = dish_name;

            const dish_photo = e.getAttribute('data-dish_photo')
            dish_photo_element.src = dish_photo;

            const dish_price = e.getAttribute('data-dish_price')
            dish_price_element.innerText = dish_price;

            //select button if in favorites

            if(favorites.includes(parseInt(dish_id))) {
                dish_favorite_heart.src = 'images/heart.png'
                dish_favorite_heart.setAttribute('isSelected', '')
            }
            else {
                dish_favorite_heart.removeAttribute('isSelected')
                dish_favorite_heart.src = 'images/heartNotSelected.png'
            }
        
            quantity_input.value = 1;
            span_quantity.innerText = 1;


            
            add_order_popup.style.display = "block"
            background_filter.style.display = "block"
            
        }

        load_popup()
    }

}
