
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('photos').addEventListener('change', function (e) {
        var files = e.target.files;

        if (files.length === 0) return;
        var reader = new FileReader(); 
        document.getElementById('gallery').innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var image = e.target.result;
                var img = document.createElement('img');
                img.src = image;
                img.classList.add('row');
                img.style.width = '300px';
                document.getElementById('gallery').appendChild(img);
            }
            reader.readAsDataURL(files[i]);
        }

    });
    document.getElementById('main-photo').addEventListener('change', function (event) {
        var files = event.target.files; // Використовуємо 'event' замість 'e'
        var reader = new FileReader();

        reader.onload = function (e) {
            var image = e.target.result;
            var img = document.createElement('img');
            img.src = image;
            img.classList.add('row');
            img.style.width = '300px';
            document.getElementById('main-photo-preview').appendChild(img);
        }

        reader.readAsDataURL(files[0]);
    });

});