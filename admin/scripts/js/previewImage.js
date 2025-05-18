function previewImage(event) {
    let input = event.target;

    const $img_preview = document.getElementById('bookCover-img');

    if(!input.files.length) return

    file = input.files[0];

    let objectURL = URL.createObjectURL(file);

    $img_preview.src = objectURL;
    $img_preview.style.display = "flex";
}