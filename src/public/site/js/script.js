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
        alert('File upload max ' + maxFileUpload + ' MB');
    } else {
        let reader = new FileReader();
        reader.onload = function () {
            let output = document.getElementById(previewImage);
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
}


/**
 *
 * @param event
 * @param limit
 */
function limitUploadFile(event, limit) {
    if (event.target.files.length > limit) {
        alert("You can select only " + limit + " images");
        event.target.value = '';
    }
}

/**
 *
 * @param content
 * @param type
 * @returns {string}
 */
function showNotification(content, type) {
    if (type === '') {
        type = 'error';
    }
    let html = '<div id="notifications">\n' +
        '    <div class="notification animated fadeInLeftMiddle fast ' + type + '">\n' +
        '        <div class="left">\n' +
        '            <i class="fa"></i>\n' +
        '        </div>\n' +
        '        <div class="right">\n' +
        '            <div class="inner">\n' + content + '</div>\n' +
        '        </div>\n' +
        '        <i class="fa fa-close close-notification"></i>\n' +
        '    </div>\n' +
        '</div>';

    $('body').append(html);

    /**
     * remove html
     */
    setTimeout(function () {
        let box = $('body #notifications');
        box.hide(300).remove();
    }, 3000);
}