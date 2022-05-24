function addEventAsArrowChanger(id_box, img_out, img_click){
    const box = document.querySelector(id_box)

    box.addEventListener('click', (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        this_box.toggleAttribute('isSelected')
        if(this_box.hasAttribute('isSelected'))
            this_box.src = img_click;
        else
            this_box.src = img_out;
    })
  }

  addEventAsArrowChanger('#down', 'images/down.png', 'images/up.png')