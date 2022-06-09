const edit_restaurant_popup = document.querySelector("#editRestaurant");


if (edit_restaurant_popup) {
    
    const background_filter = document.querySelector(".background_filter");

    const close = document.querySelector("#editRestaurant #close");

    close.addEventListener('click', ()=>{
        edit_restaurant_popup.style.display = "none"
        background_filter.style.display = "none"
        
    })

    function open_edit_restaurant_popup (e) {
        edit_restaurant_popup.style.display = "block"
        background_filter.style.display = "block"

    }

    function addEventAsPriceImageChange(){
        const img_hoover1 = 'images/euro2.png'
        const img_out1 = 'images/euro.png'
        const img_click1 = 'images/euro3.png'

        const img_hoover2 = 'images/2euro2.png'
        const img_out2 = 'images/2euro.png'
        const img_click2 = 'images/2euro3.png'

        const img_hoover3 = 'images/3euro2.png'
        const img_out3 = 'images/3euro.png'
        const img_click3 = 'images/3euro3.png'

        const euro1_img = document.querySelector('#euroo');
        const euro1_check = document.querySelector('#euro');

        const euro2_img = document.querySelector('#doiseuroo');
        const euro2_check = document.querySelector('#doiseuro');
        
        const euro3_img = document.querySelector('#treseuroo');
        const euro3_check = document.querySelector('#treseuro');
        
        function update_checkboxes(){
            if(euro1_check.checked){
                euro1_img.src = img_click1;
            }else{
                euro1_img.src = img_out1;
            }

            if(euro2_check.checked){
                euro2_img.src = img_click2;
            }else{
                euro2_img.src = img_out2;
            }

            if(euro3_check.checked){
                euro3_img.src = img_click3;
            }else{
                euro3_img.src = img_out3;
            }
        }

        function addEventsToPrice(checkbox, imagem, img_hoover, img_out){
            update_checkboxes();
            imagem.addEventListener('mouseover', () => {
                if(!checkbox.checked)
                    imagem.src = img_hoover;
                }
            )

            imagem.addEventListener('mouseout', () => {
                if(!checkbox.checked)
                    imagem.src = img_out;
                }
            )

            checkbox.addEventListener('change', (e) => {
                update_checkboxes();
            })
        }

        addEventsToPrice(euro1_check, euro1_img, img_hoover1, img_out1)
        addEventsToPrice(euro2_check, euro2_img, img_hoover2, img_out2)
        addEventsToPrice(euro3_check, euro3_img, img_hoover3, img_out3)

      }
    
      addEventAsPriceImageChange()

}