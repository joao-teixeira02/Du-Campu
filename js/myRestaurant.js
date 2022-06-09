

function loadImagePreview(query_image, query_input){
    const image = document.querySelector(query_image);
    const input = document.querySelector(query_input);

    if(input && image){

        const loadFile = function() {
            const reader = new FileReader();
            reader.onload = function(){
                image.src = reader.result;
                console.log("src")
            };
            reader.readAsDataURL(input.files[0]);
        };

        input.addEventListener('change', loadFile);

    }

}

loadImagePreview('#photo', '#fileToUpload');
