$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
});

if ( $("form#main").length ) {
	$("form#main").validate();
}

if ( $("input.numeric").length ) {
	$("input.numeric").numeric();
}

$(".server-sales").change(function() {
	var total = 0;
	$(".server-sales").each(function() {
		var sales = parseFloat( $(this).val() );
		if ( $.isNumeric(sales) ) total += sales;
	});
	$("#total-sales").attr("data-sum", total);
});