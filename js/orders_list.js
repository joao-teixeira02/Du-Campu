

function close_details_popup(){
    const details_popup = document.querySelector('#popup_order_details')
    const background_filter = document.querySelector('.background_filter')
    if(details_popup){
        details_popup.style = "display: none";
        background_filter.style = "display: none";

    }
}


function open_details_popup(e) {
    const details_popup = document.querySelector('#popup_order_details')
    const background_filter = document.querySelector('.background_filter')
    if(details_popup){

        
        getOrder(e.getAttribute('data-id_order')).then( ()=>{
            details_popup.style = "display: block";
            background_filter.style = "display: block";
        }
        )


    }
}

async function  getOrder(id){
    const response =  await fetch('/api/order.php?id='+id);
    const order_data = await response.json()
    console.log(order_data);

    const restaurant_name = document.querySelector('#popup_order_details #restaurant_name')
    const totalPice = document.querySelector('#popup_order_details #TotalPrice')
    const table_dishes = document.querySelector('#popup_order_details table')


    restaurant_name.innerHTML = order_data['restaurant']
    totalPice.innerHTML = order_data['total_price'] + '€'

    table_dishes.innerHTML = "<tr> \
    <th>Quantity</th> \
    <th>Name</th>  \
    <th>Price</th> \
    </tr>"
    
    for(const dish of order_data.dishes){
        console.log(dish)
        const tr = document.createElement('tr');
        
        const td_quantity = document.createElement('td');
        td_quantity.innerText = dish[1]
        const td_name = document.createElement('td');
        td_name.innerText = dish[0].name
        const td_price = document.createElement('td');
        td_price.innerText = (dish[0].price * dish[1]).toFixed(2)

        tr.appendChild(td_quantity)
        tr.appendChild(td_name)
        tr.appendChild(td_price)

        table_dishes.appendChild(tr)


    }

}


