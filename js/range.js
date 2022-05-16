function rangeLeft(){
    let range = document.getElementById("rangeLeft");
    range.value=Math.min(range.value,range.parentNode.childNodes[5].value-0.5);
    let value = (range.value/parseInt(range.max))*100;
    let  children = range.parentNode.childNodes[1].childNodes;
    children[1].style.width=value+'%';
    children[5].style.left=value+'%';
    children[7].style.left=value+'%';children[11].style.left=value+'%';
    children[11].childNodes[1].innerHTML=range.value;
}

function rangeRight(){
    let range = document.getElementById("rangeRight");
    range.value=Math.max(range.value,range.parentNode.childNodes[3].value-(-0.5));
    let value = (range.value/parseInt(range.max))*100;
    let children = range.parentNode.childNodes[1].childNodes;
    children[3].style.width=(100-value)+'%';
    children[5].style.right=(100-value)+'%';
    children[9].style.left=value+'%';children[13].style.left=value+'%';
    children[13].childNodes[1].innerHTML=range.value;
}