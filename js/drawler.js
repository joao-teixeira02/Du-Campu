
window.addEventListener('scroll', updateFilterPosition);
window.addEventListener('load', updateFilterPosition)
window.addEventListener('resize', updateFilterPosition)


const filters = document.querySelector('.filters');
const drawler = document.querySelector('#drawler_button');

if (window.matchMedia('(max-width: 60em)').matches && drawler) {
    drawler.checked = true;
}

updateFilterPosition()

function updateFilterPosition()  {
    if (window.matchMedia('(max-width: 60em)').matches) {
        
        const filters = document.querySelector('.filters');
        const header = document.querySelector('body > header');
        
        if(filters){
            offset = header.getBoundingClientRect().y + header.getBoundingClientRect().height;

            if(offset>0){
                filters.style.top = offset+"px";
            }else{
                filters.style.top = 0+"px";
            }


        }

    }

}


