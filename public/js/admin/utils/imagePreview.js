function setupImagePreview() {
    var imageInput = document.getElementById('icon');
    var preview = document.getElementById('icon_preview');

    if (imageInput) {
        imageInput.addEventListener('change', function (event) {
            var files = event.target.files;
            if (files.length === 0) return;

            var file = files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                var image = e.target.result;
                preview.src = image;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(file);
        });
    }
}
