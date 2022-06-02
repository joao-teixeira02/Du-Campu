function addEventAsLikeButton(id_box, img_hoover, img_out, img_click){
    const boxes = document.querySelectorAll(id_box)

    for (const box of boxes){
    box.addEventListener('click', async (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        this_box.toggleAttribute('isSelected')
        if(this_box.hasAttribute('isSelected')) {
            this_box.src = img_click; 
            await fetch('/action/action_add_favorite_restaurant.php?r_id=' + this_box.getAttribute('data-id'));
        }
        else {
            this_box.src = img_out;
            await fetch('/action/action_remove_favorite_restaurant.php?r_id=' + this_box.getAttribute('data-id'));
        }
    })

    box.addEventListener('mouseover', (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        if(!this_box.hasAttribute('isSelected'))
            box.src = img_hoover;
        })
    box.addEventListener('mouseout', (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        if(!this_box.hasAttribute('isSelected'))
            box.src = img_out;
        }
        )
  }
}
