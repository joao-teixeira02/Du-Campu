const search = document.querySelector('.search-bar input[type=search]')
const rangeL = document.querySelector('.range-min')
const rangeR = document.querySelector('.range-max')
const categories_input = document.querySelectorAll('.categories input')
const asc = document.querySelector('#asc')
const sorter = document.querySelector('#sorter')

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

updateRestaurantList();



async function updateRestaurantList() {

    min_rating = rangeL.value
    max_rating = rangeR.value
    list_categories_str = "";

    for(category of categories_input){
      if(category.checked){
        list_categories_str += category.id + ",";
      }
    }

    const response = await fetch('/api/api_restaurants.php?name=' + search.value + '&category='+ list_categories_str
                                  + "&rating_min="+min_rating+"&rating_max=" + max_rating+ "&order=" + sorter.value + "&asc=" + (asc.checked?1:0) );
    const restaurants = await response.json()

    const response1 =  await fetch('/api/api_get_favorite_restaurants.php')
    const favorites = await response1.json()

    const section = document.querySelector('.restaurants')
    section.innerHTML = ''

    for (const restaurant of restaurants) {
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
      price.innerHTML = "€"
      restaurantInfo.appendChild(price)

      const likeIcon = document.createElement('img')
      likeIcon.setAttribute("id", "likeIcon"+restaurant.id)
      likeIcon.setAttribute("data-id", restaurant.id)
      if (favorites.includes(restaurant.id)){
        likeIcon.setAttribute('isSelected', '')
        likeIcon.src = 'images/heart.png'
      }
      else
        likeIcon.src = 'images/heartNotSelected.png'
      likeIcon.classList.add("likeIcon")
      likeIcon.style.width = "30px"
      likeIcon.style.height = "30px"
      restaurantInfo.appendChild(likeIcon)


      restaurantContainer.appendChild(restaurantInfo)
      section.appendChild(restaurantContainer)
      
    }
    
    addEventAsLikeButton('.likeIcon', 'images/heartHoover.png', 'images/heartNotSelected.png', 'images/heart.png')
}

