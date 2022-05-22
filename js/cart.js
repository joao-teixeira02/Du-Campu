
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
        console.log(cart_box.style.opacity )
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
            console.log(this_checkbox_img + "\n" + lala)
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

    if(cart_info_map.size == 0){
        // empty
        const empty_cart = document.querySelector("#empty_cart");
        const main = document.querySelector('#cart_box main');
        
        if(main){
            main.style.gridRow = "";
            main.style.overflowY = "";
        }

        empty_cart.style.display = "block";
        check_in.style.display = "none";
        return
    }


    const list_cart = document.createElement('ul')
    list_cart.setAttribute("id", "list_cart")

    for (const [restaurant_id, restaurant_orders] of cart_info_map) {
        console.log(restaurant_orders)
        const restaurant_li = document.createElement('li')

        // restaurant checkbox
        const restaurant_checkbox = document.createElement('input')
        restaurant_checkbox.setAttribute("type", "checkbox");
        restaurant_checkbox.setAttribute("id", "restaurant_checkbox"+ restaurant_id);
        restaurant_li.appendChild(restaurant_checkbox);
        // restaurant checkbox fim
        
        // restaurant checkbox label
        const restaurant_label = document.createElement('label')
        list_cart.setAttribute("for", "restaurant_checkbox"+restaurant_id);
            
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
            dish_li.innerHTML = '\
            <img class="red_cross" clickable src="images/red_cross.png" width="10px" height="10px" alt="remove item"/> '
            
            const options_select = document.createElement('select')
            options_select.innerHTML = "";
            for(let i = 1; i <= 99; i++){
                options_select.innerHTML += "<option value="+i+">"+i+"</option>"
            }

            options_select.value = order.quantity
            dish_li.appendChild(options_select)

            const dish_name = document.createElement('span')
            dish_name.innerText = order.dish.name;

            const dish_price = document.createElement('span')
            dish_price.classList.add("cost");
            dish_price.innerText = parseFloat(order.dish.price*order.quantity).toFixed(2)

            dish_li.appendChild(dish_name);
            dish_li.appendChild(dish_price);


            orders_list.appendChild(dish_li);

        }
        restaurant_li.appendChild(orders_list);
        // orders_list fim
        

        list_cart.appendChild(restaurant_li)
    }
    const main = document.querySelector('#cart_box main');
    
    if(main){
        main.innerHTML = ""
        main.appendChild(list_cart);
        main.style.gridRow = 2;
        main.style.overflowY = "scroll";
    }

    check_in.style.display = "block";
    
}




