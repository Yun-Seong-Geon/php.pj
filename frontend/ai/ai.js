function displayImage() {
    var input = document.getElementById('input_image');
    var imageContainer = document.getElementById('AI_image');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            imageContainer.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}