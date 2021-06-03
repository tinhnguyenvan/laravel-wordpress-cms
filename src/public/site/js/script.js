if ($('.js-example-basic-single').length > 0) {
    $(".js-example-basic-single").select2({
        theme: 'bootstrap4',
    });
}


/**
 * preview image
 */
function previewImage(event, previewImage) {
    let maxFileUpload = parseInt(configs.MAX_FILE_UPLOAD);
    let size = ((event.target.files[0].size) / (1024 * 1024)).toFixed(2);
    if (size > maxFileUpload) {
        showNotification('File upload max ' + maxFileUpload + ' MB', 'error');
    } else {
        let reader = new FileReader();
        reader.onload = function () {
            let output = document.getElementById(previewImage);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
}