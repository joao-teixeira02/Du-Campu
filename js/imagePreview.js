

function loadImagePreview(imagecontainer){
    const container = document.querySelectorAll(imagecontainer)

    for(const c of container){
        const image = c.querySelector('img');
        const input = c.querySelector('input[type="file"]');

        if(input && image){

            const loadFile = function() {
                const reader = new FileReader();
                reader.onload = function(){
                    image.src = reader.result;
                };
                reader.readAsDataURL(input.files[0]);
            };

            input.addEventListener('change', loadFile);

        }

    }

}

loadImagePreview('#image-container');

loadImagePreview('#photo_field');
