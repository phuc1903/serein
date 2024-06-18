function chooseImage() {
    document.getElementById('typeFile').click();
}

function chooseBackground() {
    var input = document.getElementById('backgroundInput');
    input.click();
}


function previewImage(input) {
    var preview = document.getElementById('avatar');
    var file = input.files[0];
    
    if (file) {
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = 'Public/img/default.jpg?t=' + new Date().getTime();
    }
}

function previewBackground(input) {
    var preview = document.getElementById('avatarImage');
    var file = input.files[0];
    
    if (file) {
        var reader = new FileReader();
        reader.onloadend = function () {
            preview.src = reader.result;
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = 'Public/img/default.jpg?t=' + new Date().getTime();
    }
}


function changeImage(thumbnail) {
    // Lấy đường dẫn ảnh từ thumbnail đã click
    var newSrc = thumbnail.src;

    // Thay đổi đường dẫn ảnh của img-main thành đường dẫn mới
    document.querySelector('.img-main').src = newSrc;

    // Lấy tất cả các thumbnails-item và loại bỏ lớp active (nếu có) để làm mới trạng thái
    var thumbnailsItems = document.querySelectorAll('.thumbnails-item');
    thumbnailsItems.forEach(function(item) {
        item.classList.remove('active');
    });

    // Thêm lớp active cho thumbnail-item đã click
    thumbnail.classList.add('active');
}

function handleThumbnailClick(event) {
    // Ngăn chặn sự kiện click trên cha (listimg) để tránh xung đột với sự kiện của từng thumbnail
    event.stopPropagation();
}