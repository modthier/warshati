$('#btn-print').on('click',function () {
	$('#invoice-POS').printThis({
		importCSS: true
	});
});