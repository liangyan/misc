$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
});

if ( $("form#main").length ) {
	$("form#main").validate();
	$("form#main").submit(function() {
		var checkedInputs = $(this).find('input[name="location"]:checked');
		if (!checkedInputs.length) {
			alert("You must check one location!");
			return false;
		}
	});
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
	if ($.isNumeric(parseFloat(input.val()))) inputVal = parseFloat(input.val());

	console.log(inputVal+" vs. " + parseFloat(input.attr("data-sum")));

	var diff = Math.abs( inputVal - parseFloat(input.attr("data-sum")) );
	if (  diff < 0.0001  ) {
		notice.hide();
	} else {
		notice.show();
	}
});