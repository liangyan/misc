$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
});

if ( $("form#main").length ) {
	$("form#main").validate();
}

if ( $("input.numeric").length ) {
	$("input.numeric").numeric();
}

$(".server-sales").keyup(function() {
	var total = 0;
	$(".server-sales").each(function() {
		var sales = parseFloat( $(this).val() );
		if ( $.isNumeric(sales) ) total += sales;
	});
	$("#total-sales").attr("data-sum", total).trigger("keyup");
});

$("#total-sales").keyup(function() {
	var input = $(this);
	var notice = $(".wrong-number");
	
	var inputVal = 0;
	if ($.isNumeric(parseInt(input.val()))) inputVal = parseInt(input.val());

	var diff = Math.abs( inputVal - parseInt(input.attr("data-sum")) );
	if (  diff < 0.0001  ) {
		notice.hide();
	} else {
		notice.show();
	}
});