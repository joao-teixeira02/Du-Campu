const rangeL = document.querySelector('#rangeLeft')
const rangeR = document.querySelector('#rangeRight')
const categories_input = document.querySelectorAll('.categories input')
if (rangeL) {
  rangeL.addEventListener('input', updateRestaurantList)
}
if (rangeR) {
  rangeR.addEventListener('input', updateRestaurantList)
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


    const response = await fetch('api_restaurants.php?name=&category'+ list_categories_str
                                  + "&rating_min="+min_rating+"&rating_max=" + max_rating)
    const restaurants = await response.json()

    console.log(restaurants);

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
        else category.innerHTML +=  " , " + c
    
      }
      restaurantInfo.appendChild(category)

      const price = document.createElement('span')
      price.setAttribute("id", "price")
      price.innerHTML = "$"
      restaurantInfo.appendChild(price)

      const like_button = document.createElement('button')
      like_button.setAttribute("id", "like-button")
      like_button.setAttribute("type", "button")
      restaurantInfo.appendChild(like_button)

      restaurantContainer.appendChild(restaurantInfo)
      section.appendChild(restaurantContainer)
      
    }

    /*
    <div class = "restaurantContainer" > 
                    <img src = "https://picsum.photos/150/150?" alt = "">
                    <article class = "restaurantInfo">
                        <span id = "name">Restaurante do Zé</span>
                        <span id = "address">Rua dos martelinhos 304</span>
                        <span id = "rating">rating</span>
                        <span id = "category">categoria</span>
                        <span id = "price">Intervalo de preço: € - €€ </span>
                        <button type = "button" id = "like-button" ></button>
                    </article>
                </div>
    */

  }