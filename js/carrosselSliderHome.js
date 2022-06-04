const restaurantContainers = [...document.querySelectorAll('.restaurant-container')]
const nxtBtn = [...document.querySelectorAll('.nxt-btn')]
const preBtn = [...document.querySelectorAll('.pre-btn')]

 restaurantContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect()
    let containerWidth = containerDimensions.width/2
    const velocity = 5;

    nxtBtn[i].addEventListener('click', () => {
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

    preBtn[i].addEventListener('click', () => {
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