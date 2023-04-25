/**
 * Created by Mohammad on 15/02/2016.
 */
$(function () {
	$('img').each(function (e) {
		var src = $(e).attr('src');
		$(e).hover(function () {
			$(this).attr('src', src.replace('.gif', '.png'));
		}, function () {
			$(this).attr('src', src);
		});
	});
});