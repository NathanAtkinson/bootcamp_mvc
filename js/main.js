/**
 * Application JS
 */
(function() {

	/*$.ajaxSetup({
		type: 'POST',
		dataType: 'json',
		cache: false
	});*/http://benalman.com/news/

	

	var form = new ReptileForm('form');

	// Do something before validation starts
	/*form.on('beforeValidation', function() {
		$('body').append('<p>Before Validation</p>');
	});*/

	// Do something when errors are detected.
	form.on('validationError', function(e, err) {
		// console.log(err);
		// alert("Error! " + JSON.stringify(err[0].msg));
		console.log("Error! " + JSON.stringify(err));
		
	});

	// Do something after validation is successful, but before the form submits.
	/*form.on('beforeSubmit', function() {
		$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	});*/

	// Do something when the AJAX request has returned in success
	form.on('xhrSuccess', function(e, data) {
		// if a redirect key is received, then do this.
		if (data.redirect) {
			location.href = data.redirect;
		} else if (data.notice) {
			// alert user of error
		}
		$('body').append('<p>Received Data: ' + JSON.stringify(data) + '</p>');

	});

	// Do something when the AJAX request has returned with an error
	form.on('xhrError', function(e, xhr, settings, thrownError) {
		$('body').append('<p>Submittion Error</p>');
	});

})();




$(function() {

	$('body').on('click', 'button', function(e) {
		// e.preventDefault();
		console.log('Button pressed');

	});

	$('button#add-item').click(function(e) {
		e.preventDefault();
		var invoice_id = $(this).parents('form').find("input[name='invoice_id']").val();
		var price = $(this).parent().find("#product_id option:selected").attr('data-price');
		var product_name = $(this).parent().find("#product_id option:selected").text();
		var product_id = $(this).parent().find("#product_id option:selected").val();
		var quantity = $(this).parent().find("input[name='quantity']").val();
		var user_id = $(this).parents('form').find("input[name='user_id']").val();

		var total = price * quantity;

		$array = $.ajax({
				url: '/invoices/process_invoice',
				type: 'POST',
				dataType: 'json',
				// contentType: "application/json; charset=utf-8",
				cache: false,
				data: {product_id: product_id, invoice_id: invoice_id, quantity: quantity},
				async: false,
				success: function(data){
					console.log('success');
					console.log(data);
					$('tbody tr').remove();
					var grandtotal = 0;
					for (var index in data.line_items) {
						// var subtotal = row['price'] * row['quantity'];
						var item = data.line_items[index];
						total = item.quantity * item.price;
						grandtotal += total;
						$('tbody').append('<tr><td><input type="hidden" name="product_id" value="' + 
								item.product_id + '">' + item.name + '</td><td>' + 
								item.price + '</td><td name="quantity">' + item.quantity + '</td><td>' + 
								total + '</td><td><button class="remove-item"> Remove </button></td></tr>');
					}
					$('tbody').append('<tr><td colspan="3">TOTAL</td><td colspan="2">' + grandtotal + '</td></tr>');



					// return array;
				},
				error: function(){
					console.log('error');
				}

		});

// how to deal with repeat items?

		// $.post( "/invoices/process_invoice", to_submit);
		// $('table').append('<tr><input type="hidden" name="product_id" value="' + product_id + '"><td name="remove">' + product_name + '</td><td >' + price + '</td><td name="quantity">' + quantity + '</td><td>' +  total + '<button class="remove-item"> Remove </button></td></tr>');
	});

	$('table').on('click', '.remove-item', function() {
		console.log(this);
		//remove the line-item that matches this line

		var product_id = $(this).parents('tr').find("input[name='product_id']").val();
		console.log(product_id);

		// can't select via post method with this...
		var invoice_id = $('body').find("input[name='invoice_id']").val();
		var tr = $(this).parents('tr');
		//TODO have to pass along a redirect into data.
		$array = $.ajax({
				url: '/invoices/process_invoice',
				type: 'POST',
				dataType: 'json',
				cache: false,
				data: {remove: product_id, invoice_id: invoice_id},
				async: false,
				success: function(data){
					console.log(this);
					console.log('row deleted');
					// this is the data, not the button
					// var tr = $(this).parents('tr');
					console.log(tr);
					tr.remove();
				},
				error: function(){
					console.log('error');
				}

		});

	});


});