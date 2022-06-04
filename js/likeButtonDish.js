function addEventAsLikeButton(id_box, img_hoover, img_out, img_click){
    const popupHeart = document.querySelectorAll(id_box)

    popupHeart.addEventListener('click', async (e) => {
        popupHeart.toggleAttribute('isSelected')
        const heart = document.querySelector(".comida[data-dish_id=" + popupHeart.getAttribute('data-id_id') + "] #heart_favorite")


        console.log(".comida[data-dish_id=" + this_box.getAttribute('data-dish_id') + "] #heart_favorite")
        if(popupHeart.hasAttribute('isSelected')) {
            console.log(img_click)
            heart.setAttribute('isSelected', "")
            popupHeart.src = img_click; 
            await fetch('/action/action_add_favorite_dish.php?d_id=' + popupHeart.getAttribute('data-id_id'));
        }
        else {
            heart.removeAttribute('isSelected')
            popupHeart.src = img_out;
            await fetch('/action/action_remove_favorite_dish.php?d_id=' + popupHeart.getAttribute('data-id_id'));
        }
        heart.src = this_box.src;

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

addEventAsLikeButton("#add_order #heart_favorite", 'images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png')

