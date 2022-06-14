const warnings = document.querySelector('#messages');



if(warnings){
    setTimeout(()=>{
        warnings.innerHTML = "";
        clearTimeout(myTimeout);

    }, 5000);

}