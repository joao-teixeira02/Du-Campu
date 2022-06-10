const add_type_popup = document.querySelector("#addDishType");
const background_filter5 = document.querySelector(".background_filter");

if (add_type_popup) {

    const close = document.querySelector("#addDishType #close");

    close.addEventListener('click', ()=>{
        add_type_popup.style.display = "none"
        background_filter5.style.display = "none"
        
    })

    const dish_restaurant_id_element = document.querySelector("#addDishType #id")

    function open_add_type_popup(e) {

        const dish_restaurant_id = e.getAttribute('data-dish_restaurant_id')
        dish_restaurant_id_element.value = dish_restaurant_id;
        
        add_type_popup.style.display = "block"
        background_filter5.style.display = "block"

    }

}