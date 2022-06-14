async function showLikeIcon() {
    const likeRestaurant = document.querySelector('#likeRestaurant')
    if(likeRestaurant){
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

}

function createEventLikeRestaurantButton(img_hoover, img_out, img_click) {
    const likeRestaurant = document.querySelector('#likeRestaurant')
    if(!likeRestaurant) return;

    likeRestaurant.addEventListener('click', async () => {
        likeRestaurant.toggleAttribute('isSelected')
        if(likeRestaurant.hasAttribute('isSelected')) {
            likeRestaurant.src = img_click;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/action/action_add_favorite_restaurant.php', false);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('r_id=' + likeRestaurant.getAttribute('data-restaurant_id')+'&csrf=' + likeRestaurant.getAttribute('csrf'));
        }
        else {
            likeRestaurant.src = img_out;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/action/action_remove_favorite_restaurant.php', false);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send('r_id=' + likeRestaurant.getAttribute('data-restaurant_id')+'&csrf=' + likeRestaurant.getAttribute('csrf'));
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
