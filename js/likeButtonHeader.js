async function showLikeIcon() {
    const likeRestaurant = document.querySelector('#likeRestaurant')
    const response1 =  await fetch('/api/api_get_favorite_restaurants.php')
    const favorites = await response1.json()
    if (favorites.includes(parseInt(likeRestaurant.getAttribute('data-restaurant_id')))){
        likeRestaurant.setAttribute('isSelected', '')
        likeRestaurant.src = 'images/heart.png'
    }
    else {
        likeRestaurant.src = 'images/heartNotSelected.png'
        likeRestaurant.removeAttribute('isSelected')
    }

}

function createEventLikeRestaurantButton(img_hoover, img_out, img_click) {
    const likeRestaurant = document.querySelector('#likeRestaurant')
    likeRestaurant.addEventListener('click', async () => {
        likeRestaurant.toggleAttribute('isSelected')
        if(likeRestaurant.hasAttribute('isSelected')) {
            likeRestaurant.src = img_click; 
            await fetch('/action/action_add_favorite_restaurant.php?r_id=' + likeRestaurant.getAttribute('data-restaurant_id'));
        }
        else {
            likeRestaurant.src = img_out;
            await fetch('/action/action_remove_favorite_restaurant.php?r_id=' + likeRestaurant.getAttribute('data-restaurant_id'));
        }
    })
    
    likeRestaurant.addEventListener('mouseover', () => {
        if(!likeRestaurant.hasAttribute('isSelected'))
            likeRestaurant.src = img_hoover;
        })
    likeRestaurant.addEventListener('mouseout', () => {
        if(!likeRestaurant.hasAttribute('isSelected'))
            likeRestaurant.src = img_out;
        }
        )
}


showLikeIcon()

createEventLikeRestaurantButton('images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png')
