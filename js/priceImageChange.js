function addEventAsPriceImageChange(id_box, img_hoover, img_out, img_click){
    const box = document.querySelector(id_box)

    box.addEventListener('click', (e) => {
        const this_box= document.getElementById(e.srcElement.id)
        this_box.toggleAttribute('isSelected')
        if(this_box.hasAttribute('isSelected'))
            this_box.src = img_click;
        else
            this_box.src = img_out;
    })

    box.addEventListener('mouseover', () => {
        if(!box.hasAttribute('isSelected'))
            box.src = img_hoover;
        })
    box.addEventListener('mouseout', () => {
        if(!box.hasAttribute('isSelected'))
            box.src = img_out;
        })
  }

  addEventAsPriceImageChange('#euroo', 'images/euro2.png', 'images/euro.png', 'images/euro3.png')
  addEventAsPriceImageChange('#doiseuroo', 'images/2euro2.png', 'images/2euro.png', 'images/2euro3.png')
  addEventAsPriceImageChange('#treseuroo', 'images/3euro2.png', 'images/3euro.png', 'images/3euro3.png')
