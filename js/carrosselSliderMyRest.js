const myRestaurantsList = [...document.querySelectorAll('.myRestaurantsList')]
const nxtBtn3 = [...document.querySelectorAll('.nxt-btn3')]
const preBtn3 = [...document.querySelectorAll('.pre-btn3')]

myRestaurantsList.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect()
    let containerWidth = containerDimensions.width/2
    const velocity = 5;

    nxtBtn3[i].addEventListener('click', () => {
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

    preBtn3[i].addEventListener('click', () => {
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