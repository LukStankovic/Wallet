/**
 * Created by lukstankovic on 27.02.17.
 */

$("document").ready(function () {

	$(".req").blur(function() {
		$(".req").each(function() {
			if(!$.trim($(this).val())) {
				$(this).removeClass("valid").addClass("invalid");
			} else {
				$(this).removeClass("invalid").addClass("valid");
			}
		});
	});

	$("input:not(.req)").blur(function() {
		$("input:not(.req)").each(function() {
			$(this).addClass("valid");
		});
	});

	$("textarea:not(.req)").blur(function() {
		$("input:not(.req)").each(function() {
			$(this).addClass("valid");
		});
	});

	$("button[name=Save]").click(function () {
		$(".req").each(function() {
			if(!$.trim($(this).val())) {
				event.preventDefault();
				$(this).removeClass("valid").addClass("invalid").effect( "shake", { direction: "left", times: 2, distance: 5}, 500);
			}
		});

		$("input:not(.req)").each(function() {
			$(this).addClass("valid");
		});

		$("textarea:not(.req)").each(function() {
			$(this).addClass("valid");
		});
	});

});