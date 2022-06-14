

/* add order popup*/

const add_order_popup = document.querySelector("#add_order");
const background_filter2 = document.querySelector(".background_filter");

if(add_order_popup){

    const close = document.querySelector("#add_order #close");
    const img_minus = document.querySelector("#add_order #minus_dish");
    const img_plus = document.querySelector("#add_order #add_dish");
    const span_quantity = document.querySelector("#add_order #quantity");
    const quantity_input = document.querySelector("#add_order #quantity_input");

    close.addEventListener('click', ()=>{
        add_order_popup.style.display = "none"
        background_filter2.style.display = "none"
        
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
        background_filter2.style.display = "block"

    }

    function open_add_order_popup_favorite(e){
        if(window.event.target.id == 'heart_favorite')
            return

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
            background_filter2.style.display = "block"
            
        }

        load_popup()
    }

    function addEventDishAsLikeButton(id_box, img_hoover, img_out, img_click){
        const popupHeart = document.querySelector(id_box)
        
    
        popupHeart.addEventListener('click', async (e) => {
            popupHeart.toggleAttribute('isSelected')
            const heart = document.querySelector(".comida[data-dish_id='" + id_dish_input.value + "'] #heart_favorite")
            
            if(popupHeart.hasAttribute('isSelected')) {
                heart.setAttribute('isSelected', "")
                popupHeart.src = img_click; 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/action/action_add_favorite_dish.php', false);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('d_id=' + id_dish_input.value+'&csrf=' + heart.getAttribute('csrf'));
            }
            else {
                heart.removeAttribute('isSelected')
                popupHeart.src = img_out;
                var xhr = new XMLHttpRequest()
                xhr.open('POST', '/action/action_remove_favorite_dish.php', false);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('d_id=' + id_dish_input.value+'&csrf=' + heart.getAttribute('csrf'));
            }
            heart.src = popupHeart.src;
    
        })
    
    
        popupHeart.addEventListener('mouseover', (e) => {
            if(!popupHeart.hasAttribute('isSelected'))
                popupHeart.src = img_hoover;
            })
            
        popupHeart.addEventListener('mouseout', (e) => {
            if(!popupHeart.hasAttribute('isSelected'))
                popupHeart.src = img_out;
            }
            )
      
    }
    
    addEventDishAsLikeButton("#add_order #heart_favorite", 'images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png')

}


function addDishLikesButtons(img_hoover, img_out, img_click){
    const dish_like_buttons = document.querySelectorAll('#heart_favorite');

    for(const heart_button of dish_like_buttons){
        const id_dish =  heart_button.getAttribute('data-dish_id');

        heart_button.addEventListener('click', async (e) => {
            heart_button.toggleAttribute('isSelected')
            
            if(heart_button.hasAttribute('isSelected')) {
                heart_button.src = img_click; 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/action/action_add_favorite_dish.php', false);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('d_id=' + id_dish + '&csrf=' + heart_button.getAttribute('csrf'));
            }
            else {
                heart_button.src = img_out;
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/action/action_remove_favorite_dish.php', false);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('d_id=' + id_dish +'&csrf=' + heart_button.getAttribute('csrf'));
            }
            
    
        })
    
    
        heart_button.addEventListener('mouseover', (e) => {
            if(!heart_button.hasAttribute('isSelected'))
                heart_button.src = img_hoover;
            })
            
        heart_button.addEventListener('mouseout', (e) => {
            if(!heart_button.hasAttribute('isSelected'))
            heart_button.src = img_out;
            }
            )
    }
    
}

addDishLikesButtons( 'images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png');
