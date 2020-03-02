/*
 * @author: nguyentinh
 * @create: 11/18/19, 11:00 AM
 */

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

if (jQuery('#editor1').length > 0) {
	CKEDITOR.replace('editor1', {
		filebrowserUploadUrl: configs.filebrowserUploadUrl,
		filebrowserUploadMethod: 'form'
	});
}

/**
 * js table tree item
 */
if ($('#simple-tree-table').length > 0) {
	$('#simple-tree-table').simpleTreeTable({
		opened: 'all',
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
