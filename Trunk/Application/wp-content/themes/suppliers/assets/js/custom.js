$('.object-label').on('click', function(){
		$('.object-label').not(this).find($('.object-info')).fadeOut(200);
		$(this).find('.object-info').fadeToggle(200);
});