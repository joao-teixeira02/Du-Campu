
const cart_box = document.querySelector("#cart_box");
var desaparecerCartTimerON = false
var aparecerCartTimerON = false
var id = 0

function close_cart(){
    cart_box.removeAttribute("display_block");
} 

function show_cart(){
    if(aparecerCartTimerON)  
        return
    
    if(desaparecerCartTimerON)  
        clearInterval(id);

    cart_box.style.opacity = 0;
    
    cart_box.setAttribute("display_block", "");
    opacity_value = 0;
    
    id = window.setInterval(aparecer, 10);
    aparecerCartTimerON = true;
    function aparecer() {
        console.log(cart_box.style.opacity )
        if (cart_box.style.opacity != 1) {
            opacity_value+=0.1
            
            cart_box.style.opacity = opacity_value.toFixed(1);
            setTimeout(aparecer, 0.1)
        }else{
            aparecerCartTimerON = false;
            clearInterval(id);
        }
    }

} 

document.addEventListener("scroll", close_cart);

/* Minimizing Restaurant Orders*/

const checkbox_list = document.querySelectorAll('#list_cart input[type="checkbox"]');

for(const minimizing_checkbox of checkbox_list){
    minimizing_checkbox.addEventListener("change", (e) => {
            const this_checkbox = document.querySelector("#"+e.target.id);

            let lala = "#" + e.target.id +" ~ * .cart_arrow"; 
            
            const this_checkbox_img = document.querySelector(lala);
            console.log(this_checkbox_img + "\n" + lala)
            if(this_checkbox.checked){
                this_checkbox_img.src = "images/arrow_up.png"
            }else{
                this_checkbox_img.src = "images/arrow_down.png"
            }
        });

}


