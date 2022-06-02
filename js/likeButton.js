function addEventAsLikeButton(id_box, img_hoover, img_out, img_click){
    const boxes = document.querySelectorAll(id_box)

    for (const box of boxes){
    box.addEventListener('click', (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        console.log(this_box.getAttribute('data-id'));
        this_box.toggleAttribute('isSelected')
        if(this_box.hasAttribute('isSelected'))
            this_box.src = img_click;
        else
            this_box.src = img_out;
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
        })
  }
}
