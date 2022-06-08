const edit_restaurant_popup = document.querySelector("#editRestaurant");
const background_filter3 = document.querySelector(".background_filter");

if (edit_restaurant_popup) {

    const close = document.querySelector("#editRestaurant #close");

    close.addEventListener('click', ()=>{
        edit_restaurant_popup.style.display = "none"
        background_filter3.style.display = "none"
        
    })

    const id_restaurant_input = document.querySelector("#restaurant_info #id_restaurant_input");
    const restaurant_photo_element = document.querySelector("#img_restaurant");
    const restaurant_name_element = document.querySelector("#restaurant_info #restaurant_name");
    const restaurant_address_element = document.querySelector("#restaurant_info #restaurant_address");
    const restaurant_categories_element = document.querySelector("#restaurant_info #restaurant_categories");

    function open_edit_restaurant_popup(e) {

        const restaurant_id = e.getAttribute('data-restaurant_id')
        id_restaurant_input.value = restaurant_id;

        const restaurant_name = e.getAttribute('data-restaurant_name')
        restaurant_name_element.value = restaurant_name;
        restaurant_name_element.placehoder = restaurant_name;

        const restaurant_photo = e.getAttribute('data-restaurant_photo')
        restaurant_photo_element.src = restaurant_photo;

        const restaurant_address = e.getAttribute('data-restaurant_address')
        restaurant_address_element.value = restaurant_address;
        restaurant_address_element.placehoder = restaurant_address;

        const restaurant_categories = e.getAttribute('data-restaurant_categories')
        restaurant_categories_element.value = restaurant_categories;
        restaurant_categories_element.placehoder = restaurant_categories;
        
        edit_restaurant_popup.style.display = "block"
        background_filter3.style.display = "block"

    }

}