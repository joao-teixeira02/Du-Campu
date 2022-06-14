function addEventAsLikeButton(id_box, img_hoover, img_out, img_click){
    const boxes = document.querySelectorAll(id_box)

    for (const box of boxes){
    box.addEventListener('click', async (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        this_box.toggleAttribute('isSelected')
        if(this_box.hasAttribute('isSelected')) {
            this_box.src = img_click;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/action/action_add_favorite_restaurant.php', false);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('r_id=' + this_box.getAttribute('data-id')+'&csrf=' + this_box.getAttribute('csrf'));
        }
        else {
            this_box.src = img_out;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/action/action_remove_favorite_restaurant.php', false);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('r_id=' + this_box.getAttribute('data-id')+'&csrf=' + this_box.getAttribute('csrf'));
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
