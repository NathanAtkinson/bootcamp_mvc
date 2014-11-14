/**
 * Application JS
 */
(function() {

	var form = new ReptileForm('form');

	// Do something before validation starts
	form.on('beforeValidation', function() {
		$('body').append('<p>Before Validation</p>');
	});

	// Do something when errors are detected.
	form.on('validationError', function(e, err) {
		$('body').append('<p>Errors: ' + JSON.stringify(err) + '</p>');
	});

	// Do something after validation is successful, but before the form submits.
	form.on('beforeSubmit', function() {
		$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	});

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

	$('body').click('button', function(e) {
		// e.preventDefault();
		console.log('Button pressed');

	});

	$('button#add-item').click(function() {
		console.log(this);
		sibs = $(this).siblings();
		console.log(sibs);
		$product_name = $(this).siblings("input[name='product_id']").val();
		// $quantity = $(this).siblings().attr('name', 'quantity').val();

		// to try
		var $quantity = $(this).parent().children("input[name='quantity']").val();

		console.log('name' + $product_name);
		console.log('quantity' + $quantity);

	});

	




});