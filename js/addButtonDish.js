const add_dish_popup = document.querySelector("#addDish");
const background_filter4 = document.querySelector(".background_filter");

if (add_dish_popup) {

    const close = document.querySelector("#addDish #close");

    close.addEventListener('click', ()=>{
        add_dish_popup.style.display = "none"
        background_filter4.style.display = "none"
        
    })

    const dish_restaurant_id_element = document.querySelector("#addDish #dish_restaurant_id")
    const dish_type_element2 = document.querySelector("#addDish #dish_type");

    function open_add_dish_popup(e) {

        const dish_restaurant_id = e.getAttribute('data-dish_restaurant_id')
        dish_restaurant_id_element.value = dish_restaurant_id;

        const dish_type = e.getAttribute('data-dish_type')
        dish_type_element2.value = dish_type;
        
        add_dish_popup.style.display = "block"
        background_filter4.style.display = "block"

    }

}