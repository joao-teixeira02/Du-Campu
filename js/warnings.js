const warnings = document.querySelector('#messages');



if(warnings){
    const myTimeout = setTimeout(()=>{
        warnings.innerHTML = "";
        clearTimeout(myTimeout);

    }, 5000);

}