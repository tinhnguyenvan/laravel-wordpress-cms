/*
 * @author: nguyentinh
 * @create: 11/18/19, 11:00 AM
 */

$(document).ready(function () {
    initializeMyPlugin();

    $(document).pjax('a:not(a[target="_blank"],a[target="_top"])', '#pjax-container');

    $(document).on('pjax:end', function () {
        initializeMyPlugin();
    });

    function initializeMyPlugin() {
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

        if ($('.ckeditor').length > 0) {
            $('.ckeditor').each(function (index) {
                let $summernote = $('.ckeditor').eq(index);
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
                                url: configs.link_media_upload,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    if (parseInt(data.status) === 0) {
                                        alert(data.message);
                                    } else {
                                        let src = data.url;
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
        if ($('#product_id').length > 0) {
            let options = {
                url: function (keyword) {
                    return configs.base_url + '/api/products?keyword=' + keyword
                },
                getValue: "title",
                listLocation: "data",
                list: {
                    onClickEvent: function () {
                        let item = $("#product_id").getSelectedItemData();
                        createItemOrder(item);
                    }
                }
            };

            $("#product_id").easyAutocomplete(options);
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

        $(".date-time-picker").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d h:i K",
        });

        $(".year-picker").flatpickr({
            mode: "range",
            dateFormat: "Y",
        });
    }
});

