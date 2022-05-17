
const cart_box = document.querySelector("#cart_box");

function close_cart(){
    console.log(cart_box.hasAttribute("display_block"))

    cart_box.style.opacity = 1;
    opacity_value = 1.0;

    id = setInterval(desaparecer, 1);
    function desaparecer() {
        if (cart_box.style.opacity == 0) {
            clearInterval(id);
            
            cart_box.removeAttribute("display_block");
        } else {
            opacity_value-=0.1
            cart_box.style.opacity = opacity_value;
        }
    }
} 

function show_cart(){
    
    cart_box.style.opacity = 0;
    
    cart_box.setAttribute("display_block", "");
    opacity_value = 0;
    
    id = setInterval(aparecer, 1);
    function aparecer() {
        if (cart_box.style.opacity == 1) {
            clearInterval(id);
            
        } else {
            opacity_value+=0.1
            
            cart_box.style.opacity = opacity_value;
        }
    }

} 

document.addEventListener("scroll", close_cart);


