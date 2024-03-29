/*
 * @author: nguyentinh
 * @create: 11/18/19, 11:00 AM
 */

$(document).ready(function () {
    initializeMyPlugin();

    // if ($('#pjax-container').length > 0) {
    //     $(document).pjax('a:not(a[target="_blank"],a[target="_top"])', '#pjax-container');
    // }
    // $(document).on('pjax:end', function () {
    //     initializeMyPlugin();
    // });

    function initializeMyPlugin() {
        // remove message footer
        setInterval(function () {
            $('#alert-message-footer').hide(300);
        }, 5000);

        // initialize plugins
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**
         * set menu sidebar-minimizer
         */
        let sidebar_minimizer = $.cookie('sidebar_minimizer');

        if (parseInt(sidebar_minimizer) === 1) {
            $('body').addClass('brand-minimized sidebar-minimized');
            $('.sidebar-nav').removeClass('ps ps--active-y');
        } else {
            $('body').removeClass('brand-minimized sidebar-minimized');
            $('.sidebar-nav').addClass('ps ps--active-y');
        }

        $('.sidebar-minimizer').on('click', function () {
            if (parseInt(sidebar_minimizer) === 1) {
                sidebar_minimizer = 0;
            } else {
                sidebar_minimizer = 1;
            }

            $.cookie('sidebar_minimizer', sidebar_minimizer, {expires: 365, path: '/'});
        });

        let ckeditorContent = $('.ckeditor');

        if (ckeditorContent.length > 0) {
            if (configs.ckeditor === 'tinymce') {
                tinymce.init({
                    selector: '.ckeditor',
                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor insertdatetime advlist lists wordcount textpattern noneditable help charmap quickbars emoticons',
                    menubar: 'file edit view insert format tools table help',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                    toolbar_sticky: true,
                    autosave_ask_before_unload: true,
                    autosave_interval: '30s',
                    autosave_prefix: '{path}{query}-{id}-',
                    autosave_restore_when_empty: false,
                    autosave_retention: '2m',
                    image_advtab: true,
                    link_list: [
                        { title: 'My page 1', value: 'https://www.tiny.cloud' },
                        { title: 'My page 2', value: 'http://www.moxiecode.com' }
                    ],
                    image_list: [
                        { title: 'My page 1', value: 'https://www.tiny.cloud' },
                        { title: 'My page 2', value: 'http://www.moxiecode.com' }
                    ],
                    image_class_list: [
                        { title: 'None', value: '' },
                        { title: 'Some class', value: 'class-name' }
                    ],
                    importcss_append: true,
                    file_picker_callback: function (callback, value, meta) {
                        /* Provide file and text for the link dialog */
                        if (meta.filetype === 'file') {
                            callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                        }

                        /* Provide image and alt text for the image dialog */
                        if (meta.filetype === 'image') {
                            callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                        }

                        /* Provide alternative source and posted for the media dialog */
                        if (meta.filetype === 'media') {
                            callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                        }
                    },
                    templates: [
                        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                        { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                        { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
                    ],
                    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                    width: "100%",
                    height: 600,
                    image_caption: true,
                    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                    noneditable_noneditable_class: 'mceNonEditable',
                    toolbar_mode: 'sliding',
                    contextmenu: 'link image table',
                    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                });

            }

            if (configs.ckeditor === 'ckeditor') {
                CKEDITOR.replaceAll('ckeditor');
            }

            if (configs.ckeditor === 'ckeditor5') {
                $(document).on('submit', '.submit', function () {
                    let html = $(".ckeditor5").html();
                    $(".text-ckeditor5").val(html)
                })

                DecoupledEditor
                    .create(document.querySelector('.ckeditor5'), {
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                    })
                    .then(editor => {
                        const toolbarContainer = document.querySelector('#toolbar-container');
                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                        let content = $('.ckeditor5').closest('.box-ckeditor5').children('.text-ckeditor5').val();
                        editor.setData(content);
                    })
                    .catch(error => {

                    });
            }


            if (configs.ckeditor === 'summernote') {
                ckeditorContent.each(function (index) {
                    let $summernote = ckeditorContent.eq(index);
                    $summernote.summernote({
                        placeholder: 'Input content',
                        width: '100%',
                        height: 200,
                        callbacks: {
                            onImageUpload: function (files) {
                                let data = new FormData();
                                data.append("upload", files[0]);
                                $.ajax({
                                    data: data,
                                    type: "POST",
                                    url: configs.link_media_upload + '&type=summernote',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function (result) {
                                        if (parseInt(result.status) === 0) {
                                            alert(result.message);
                                        } else {
                                            let src = result.url;
                                            $summernote.summernote('insertImage', src, function ($image) {
                                                $image.attr('src', src);
                                            });
                                        }
                                    }
                                });
                            }
                        }
                    });
                })
            }
        }


        /**
         * js table tree item
         */
        if ($('.simple-tree-table').length > 0) {
            let data_opened = $('.simple-tree-table').attr('data-opened');
            let opened = 'all';
            if (data_opened === 'closed') {
                opened = 'closed';
            }

            $('.simple-tree-table').simpleTreeTable({
                opened: opened,
                iconPosition: ':first',
                iconTemplate: '<span />'
            });
        }

        if ($('#simple-tree-table').length > 0) {
            let data_opened = $('#simple-tree-table').attr('data-opened');
            let opened = 'all';
            if (data_opened === 'closed') {
                opened = 'closed';
            }

            $('#simple-tree-table').simpleTreeTable({
                opened: opened,
                iconPosition: ':first',
                iconTemplate: '<span />'
            });
        }

        if ($('#simple-tree-table1').length > 0) {
            let data_opened = $('#simple-tree-table1').attr('data-opened');
            let opened = 'all';
            if (data_opened === 'closed') {
                opened = 'closed';
            }

            $('#simple-tree-table1').simpleTreeTable({
                opened: opened,
                iconPosition: ':first',
                iconTemplate: '<span />'
            });
        }

        /**
         * check all for all list data
         */
        if ($('#check_all').length > 0) {
            $('#check_all').on('click', function () {
                $('.check_id').prop('checked', $(this).prop('checked'));
                displayAction('.check_id');
            });

            $('.check_id').change(function () {
                displayAction('.check_id');
            });
        }


        /**
         * check all for all list data
         */
        if ($('.clipboard').length > 0) {
            let clipboard = new ClipboardJS('.clipboard');
            clipboard.on('success', function (e) {
                console.info('Action:', e.action);
                console.info('Text:', e.text);
                console.info('Trigger:', e.trigger);

                e.clearSelection();
            });

            clipboard.on('error', function (e) {
                console.error('Action:', e.action);
                console.error('Trigger:', e.trigger);
            });
        }

        /**
         * check all for all list data
         */
        if ($('.tagsinput').length > 0) {
            $('.tagsinput').tagsinput('refresh');
        }

        $('[data-toggle="tooltip"]').tooltip();
        if ($('.date-time-picker').length > 0) {
            $(".date-time-picker").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d h:i K",
            });
        }

        if ($('.date-picker').length > 0) {
            $(".date-picker").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d",
            });
        }

        if ($('.year-picker').length > 0) {
            $(".year-picker").flatpickr({
                mode: "range",
                dateFormat: "Y",
            });
        }

        if ($('.js-example-basic-single').length > 0) {
            $(".js-example-basic-single").select2({
                theme: 'bootstrap4',
            });
        }

        if ($('.toast').length > 0) {
            setInterval(function () {
                $('.toast').hide(500)
            }, 5000);
        }
    }
});

class MyUploadAdapter {
    constructor(loader) {
        // The file loader instance to use during the upload.
        this.loader = loader;
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    // Aborts the upload process.
    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    // Initializes the XMLHttpRequest object using the URL passed to the constructor.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        // Note that your request may look different. It is up to you and your editor
        // integration to choose the right communication channel. This example uses
        // a POST request with JSON as a data structure but your configuration
        // could be different.
        xhr.open('POST', configs.link_media_upload, true);
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${file.name}.`;

        xhr.addEventListener('error', () => reject(genericErrorText));
        xhr.addEventListener('abort', () => reject());
        xhr.addEventListener('load', () => {
            const response = xhr.response;

            // This example assumes the XHR server's "response" object will come with
            // an "error" which has its own "message" that can be passed to reject()
            // in the upload promise.
            //
            // Your integration may handle upload errors in a different way so make sure
            // it is done properly. The reject() function must be called when the upload fails.
            if (!response || response.error) {
                return reject(response && response.error ? response.error.message : genericErrorText);
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            // This URL will be used to display the image in the content. Learn more in the
            // UploadAdapter#upload documentation.
            resolve({
                default: response.url
            });
        });

        // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
        // properties which are used e.g. to display the upload progress bar in the editor
        // user interface.
        if (xhr.upload) {
            xhr.upload.addEventListener('progress', evt => {
                if (evt.lengthComputable) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            });
        }
    }

    // Prepares the data and sends the request.
    _sendRequest(file) {
        // Prepare the form data.
        const data = new FormData();

        data.append('upload', file);

        // Important note: This is the right place to implement security mechanisms
        // like authentication and CSRF protection. For instance, you can use
        // XMLHttpRequest.setRequestHeader() to set the request headers containing
        // the CSRF token generated earlier by your application.

        // Send the request.
        this.xhr.send(data);
    }
}

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter(loader);
    };
}
