const favDishes = [...document.querySelectorAll('.favDishes')]
const nxtBtn2 = [...document.querySelectorAll('.nxt-btn2')]
const preBtn2 = [...document.querySelectorAll('.pre-btn2')]

if (favDishes && nxtBtn2.length !== 0 && preBtn2.length !== 0) {

 favDishes.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect()
    let containerWidth = containerDimensions.width/2
    const velocity = 5;
    
    nxtBtn2[i].addEventListener('click', () => {
        let scroll = 0;
        let id = window.setInterval(() => {
                            if(scroll+velocity >= containerWidth){
                                item.scrollLeft += containerWidth-scroll
                                clearInterval(id)
                                return
                            } 
                            item.scrollLeft += velocity
                            scroll += velocity

                        } , 0.1)
    })

    preBtn2[i].addEventListener('click', () => {
        let scroll = 0;
        let id = window.setInterval(() => {
                            if(scroll+velocity >= containerWidth){
                                item.scrollLeft -= containerWidth-scroll
                                clearInterval(id)
                                return
                            } 
                            item.scrollLeft -= velocity
                            scroll += velocity

                        } , 0.1)
    })
})
}