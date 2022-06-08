const edit_dish_popup = document.querySelector("#editDish");
const background_filter1 = document.querySelector(".background_filter");

if (edit_dish_popup) {

    const close = document.querySelector("#editDish #close");

    close.addEventListener('click', ()=>{
        edit_dish_popup.style.display = "none"
        background_filter1.style.display = "none"
        
    })

    const id_dish_input1 = document.querySelector("#dish_info #id_dish_input");
    const dish_photo_element1 = document.querySelector("#img_dish");
    const dish_name_element1 = document.querySelector("#dish_info #dish_name");
    const dish_price_element1 = document.querySelector("#dish_info #dish_price");
    const dish_type_element1 = document.querySelector("#dish_info #dish_type");

    function open_edit_dish_popup(e) {

        const dish_id = e.getAttribute('data-dish_id')
        id_dish_input1.value = dish_id;

        const dish_name = e.getAttribute('data-dish_name')
        dish_name_element1.value = dish_name;
        dish_name_element1.placehoder = dish_name;

        const dish_photo = e.getAttribute('data-dish_photo')
        dish_photo_element1.src = dish_photo;

        const dish_price = e.getAttribute('data-dish_price')
        dish_price_element1.value = dish_price;
        dish_price_element1.placehoder = dish_price;

        const dish_type = e.getAttribute('data-dish_type')
        console.log(dish_type)
        dish_type_element1.value = dish_type;
        dish_type_element1.placehoder = dish_type;
        
        edit_dish_popup.style.display = "block"
        background_filter1.style.display = "block"

    }

}