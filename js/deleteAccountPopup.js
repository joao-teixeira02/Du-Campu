const delete_popup = document.querySelector('#delete_popup')
const background_filter6 = document.querySelector(".background_filter");

if (delete_popup) {
    const no = document.querySelector('#delete_popup #delete_no');

    no.addEventListener('click', ()=>{
        delete_popup.style.display = "none"
        background_filter6.style.display = "none"
        
    })
}

function open_delete_popup() {
    delete_popup.style.display = "block"
    background_filter6.style.display = "block"
}