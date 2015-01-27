$(document).ready(function() {
	$("html").niceScroll();
	
		$('.app-name')
			.animate(
				{
				 left: 200,
				 opacity: 0.5 
				},
				{
					duration: 'slow',
					easing: 'easeOutBack'
				}
				)
				.animate(
					{ 
						left: 0,
						opacity:0.9
					}, {
					duration: 'slow',
					easing: 'easeOutBack'
			});
});