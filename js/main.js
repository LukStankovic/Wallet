/**
 * Created by lukstankovic on 27.02.17.
 */

$("document").ready(function () {

	// NAVIGATION
	var show = 0;
	$(".mobile--btn").click(function () {
		if(show == 0) {
			$("header nav ul").slideDown();
			show = 1;
		}
		else {
			$("header nav ul").slideUp();
			show = 0;
		}
	});

	// PULL DOWN BLOCKS

	var showBlock_addNew = 0;
	$(".showBlock").click(function () {
		if(showBlock_addNew == 0) {
			$(".block--add-new").slideDown();
			showBlock_addNew = 1;
		}
		else {
			$(".block--add-new").slideUp();
			showBlock_addNew = 0;
		}
	});

	// REQUIRED
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

	$("button[name=save]").click(function () {
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