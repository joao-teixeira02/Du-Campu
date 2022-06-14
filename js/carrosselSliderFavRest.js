const favRests = [...document.querySelectorAll('.favRestaurants')]
const nxtBtn1 = [...document.querySelectorAll('.nxt-btn1')]
const preBtn1 = [...document.querySelectorAll('.pre-btn1')]

 favRests.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect()
    let containerWidth = containerDimensions.width/2
    const velocity = 5;
    
    nxtBtn1[i].addEventListener('click', () => {
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

    preBtn1[i].addEventListener('click', () => {
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