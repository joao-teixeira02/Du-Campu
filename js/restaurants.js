const search = document.querySelector('.search-bar input[type=search]')
const rangeL = document.querySelector('.range-min')
const rangeR = document.querySelector('.range-max')
const categories_input = document.querySelectorAll('.categories input')
const asc = document.querySelector('#asc')
const sorter = document.querySelector('#sorter')
const csrf = sorter.getAttribute('csrf')
const price_input = document.querySelectorAll('.price-range input')

if (rangeL) {
  rangeL.addEventListener('input', updateRestaurantList)
}
if (rangeR) {
  rangeR.addEventListener('input', updateRestaurantList)
}
if(search){
  search.addEventListener('input', updateRestaurantList)
}
if (asc) {
  asc.addEventListener('input', updateRestaurantList)
}
if (sorter) {
  sorter.addEventListener('input', updateRestaurantList)
}

for(category of categories_input){
    if(category){
      category.addEventListener('input', updateRestaurantList)
    }
}

for(price of price_input) {
  if(price) {
    price.addEventListener('input', updateRestaurantList)
  }
}

updateRestaurantList();



async function updateRestaurantList() {

    min_rating = rangeL.value
    max_rating = rangeR.value
    list_categories_str = "";
    list_price_str = "";

    for(category of categories_input){
      if(category.checked){
        list_categories_str += category.id + ",";
      }
    }
    for(price of price_input) {
      if(price.checked) {
        list_price_str += price.value + ",";
      }
    }

    const response = await fetch('/api/api_restaurants.php?name=' + search.value + '&category='+ list_categories_str
                                  + "&rating_min="+min_rating+"&rating_max=" + max_rating+ "&order=" + sorter.value +
                                  "&price=" + list_price_str + "&asc=" + (asc.checked?1:0)
                                );
    const restaurants = await response.json()

    const response1 =  await fetch('/api/api_get_favorite_restaurants.php')
    const favorites = await response1.json()

    const response2 = await fetch('/api/api_get_session_id.php')
    const user_id = await response2.json()

    const section = document.querySelector('.restaurants')
    section.innerHTML = ''

    for (const restaurant of restaurants) {

      const restaurantLikeIcon = document.createElement('div')
      restaurantLikeIcon.classList.add('restaurantLikeIcon')

      const restaurantContainer = document.createElement('div')
      restaurantContainer.classList.add("restaurantContainer")

      const img = document.createElement('img')
      img.src = restaurant.photo
      restaurantContainer.appendChild(img)

      const restaurantInfo = document.createElement('article')
      restaurantInfo.classList.add("restaurantInfo")

      const name = document.createElement('span')
      name.setAttribute("id", "name")
      name.innerHTML = restaurant.name
      restaurantInfo.appendChild(name)

      const address = document.createElement('span')
      address.setAttribute("id", "address");
      address.innerHTML = restaurant.address
      restaurantInfo.appendChild(address)

      const rating = document.createElement('span')
      rating.setAttribute("id", "rating")
      rating.innerHTML = restaurant.rating.toFixed(1);
      restaurantInfo.appendChild(rating)

      const category = document.createElement('span')
      category.setAttribute("id", "category")
      for(const c of restaurant.categories){
        if(category.innerHTML == ""){
          category.innerHTML +=  c
        }
        else category.innerHTML +=  " • " + c
    
      }
      restaurantInfo.appendChild(category)

      const price = document.createElement('span')
      price.setAttribute("id", "price")
      let price_str = '';
      for (let i = 0; i < restaurant.price; i++) {
        price_str += '€';
      }
      price.innerHTML = price_str
      restaurantInfo.appendChild(price)

      if (user_id == 0) {

      }
      else if (restaurant.owner_id != user_id) {
        const likeIcon = document.createElement('img')
        likeIcon.setAttribute("id", "likeIcon"+restaurant.id)
        likeIcon.setAttribute("data-id", restaurant.id)
        likeIcon.setAttribute("csrf", csrf)
        if (favorites.includes(restaurant.id)){
          likeIcon.setAttribute('isSelected', '')
          likeIcon.src = 'images/heart.png'
        }
        else{
          likeIcon.src = 'images/heartNotSelected.png'
        }
          likeIcon.classList.add("likeIcon")
        likeIcon.style.width = "30px"
        likeIcon.style.height = "30px"
        restaurantLikeIcon.appendChild(likeIcon)
      }


      restaurantContainer.appendChild(restaurantInfo)
      restaurantLikeIcon.appendChild(restaurantContainer)
      section.appendChild(restaurantLikeIcon)

      restaurantContainer.addEventListener("click",()=>{location.href='restaurant.php?id=' + restaurant.id})
      
    }
    
    addEventAsLikeButton('.likeIcon', 'images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png')
}

