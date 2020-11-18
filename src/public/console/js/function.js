/*
 * @author: nguyentinh
 * @create: 11/18/19, 11:00 AM
 */

/**
 * Controller Nav
 * @param self
 */
function chooseNavType(self) {
	let selectedIndex = self.value;

	$('.form-group-general').hide(1);
	$('.form-group-' + selectedIndex).show(1);
}

function chooseNavSetTextForTitle(self) {
	let optionsText = $(self).find('option:selected').text();
	$('#title').val(optionsText);
}


/**
 *  display button Action multi in list view
 */
function displayAction(class_name) {
	let number = $(class_name + ':checked').length;
	if (number > 0) {
		$('.select_action').fadeIn(100);
	} else {
		$('.select_action').fadeOut(100);
	}
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

/**
 * file call
 * resources/views/admin/config/index.blade.php
 */
function testSendMailConfig() {
	let config_email_test_to = $("#config_email_test_to").val();
	let config_email_test_subject = $("#config_email_test_subject").val();
	let config_email_test_message = $("#config_email_test_message").val();

	$.ajax({
		type: 'POST',
		url: configs.admin_url + '/configs/test',
		dataType: 'json',
		data: {
			config_email_test_to: config_email_test_to,
			config_email_test_subject: config_email_test_subject,
			config_email_test_message: config_email_test_message,
		},

		success: function (data) {
			alert(data.message);
		}
	});
}

/**
 * ===== ORDER =====
 */
function createItemOrder(item) {

	let html;
	let element = $('#add-item-order');
	let price = item.price;

	if (item.price_promotion > 0 && item.price_promotion < item.price) {
		price = item.price_promotion;
	}

	let element_delete = ' <span onclick="deleteItemOrder($(this))" class="label label-danger" style="cursor: pointer"><i class="fa fa-trash-o"></i> Del</span>';

	html = '<tr class="so_item">';
	html += '<td>';
	html += '<input type="hidden" name="product_id[]" value="' + item.id + '" />';
	html += item.title + element_delete;
	html += '</td>';
	html += '<td class="text-center">';
	html += '<input autocomplete="off" value="1" name="quantity[' + item.id + ']" onchange="updateTotalOrder()" class="so_quantity form-control">';
	html += '</td>';
	html += '<td class="text-center">' + price + '</td>';
	html += '<td class="text-center">';
	html += '<input type="hidden" value="' + price + '"  class="so_total_price">';
	html += '<span class="so_sub_total">' + price + '</span></td>';
	html += '</tr>';
	element.append(html);

	// update total order updateTotalOrder
	this.updateTotalOrder();
}

/**
 * update total order
 */
function updateTotalOrder() {
	let total = 0;

	$('.so_item').each(function (index, item) {
		let price = $(item).find('.so_total_price').val();
		let quantity = $(item).find('.so_quantity').val();
		let sub_total = quantity * price;
		$(item).find('.so_sub_total').text(sub_total);

		total = total + parseInt(sub_total);
	});

	$('#so_total_final').text(total);
}

/**
 * delete item from ajax
 *
 * @param e
 */
function deleteItemOrder(e) {
	e.closest('tr.so_item').remove();

	this.updateTotalOrder();
}