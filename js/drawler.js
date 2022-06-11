
window.addEventListener('scroll', updateFilterPosition);
window.addEventListener('load', updateFilterPosition)
window.addEventListener('resize', updateFilterPosition)
window.addEventListener('click', updateFilterPosition)


const drawler_container = document.querySelector('.drawler_container');
const drawler = document.querySelector('#drawler_button');

if (window.matchMedia('(max-width: 60em)').matches && drawler) {
    drawler.checked = true;
}

updateFilterPosition()

function updateFilterPosition()  {
    if (window.matchMedia('(max-width: 60em)').matches) {
        
        const drawler_container = document.querySelector('.drawler_container');
        const header = document.querySelector('body > header');
        
        if(drawler_container){
            offset = header.getBoundingClientRect().y + header.getBoundingClientRect().height;

            if(offset>0){
                drawler_container.style.top = offset+"px";
            }else{
                drawler_container.style.top = 0+"px";
            }


        }

    }

}


