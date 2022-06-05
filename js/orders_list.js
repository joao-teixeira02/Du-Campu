

function close_details_popup(){
    const details_popup = document.querySelector('#popup_order_details')
    const background_filter = document.querySelector('.background_filter')
    if(details_popup){
        details_popup.style = "display: none";
        background_filter.style = "display: none";

    }
}


function open_details_popup(){
    const details_popup = document.querySelector('#popup_order_details')
    const background_filter = document.querySelector('.background_filter')
    if(details_popup){
        details_popup.style = "display: block";
        background_filter.style = "display: block";

    }
}

function getOrder(id){
    const response = fetch('/api/order.php?id'=id);
    response.then( ()=>{
        const restaurant_name = document.querySelector('#popup_order_details #restaurant_name')
        const totalPice = document.querySelector('#popup_order_details #TotalPrice')
        const table_dishes = document.querySelector('#popup_order_details table')

        const order_data = await response.json()

        restaurant_name.innerHTML = order_data['restaurant']
        totalPice.innerHTML = order_data['total_price'] + '€'

    } )

}


