
const cart_box = document.querySelector("#cart_box");
var desaparecerCartTimerON = false
var aparecerCartTimerON = false
var id = 0

function close_cart(){
    if(desaparecerCartTimerON )
        return
    console.log(cart_box.hasAttribute("display_block"))

    if(aparecerCartTimerON)  
        clearInterval(id);

    cart_box.style.opacity = 1;
    let opacity_value = 1.0;
    
    id = window.setInterval(desaparecer, 10);
    desaparecerCartTimerON = true;
    function desaparecer() {
        console.log(cart_box.style.opacity )
        if (cart_box.style.opacity == 0) {
            cart_box.removeAttribute("display_block");
            clearInterval(id);
            desaparecerCartTimerON = false;
        } else {
            opacity_value-=0.1
            cart_box.style.opacity = opacity_value.toFixed(1)
        }
    }
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


