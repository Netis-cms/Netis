
/*
 * Extension responsive menu for Nette ajax.
 */
(function($) {
	$.nette.ext('responsive.menu', {
		init: function() {
			$('ul.menu li').each(function() {
				if ($(this).children('li.parent a.current').length > 0 ) {
					$(this).parent().find('ul.submenu').toggle();
					$(this).parent().find('li.parent').addClass('active');
				}
			});
		},
		load: function() {
			$('.nav .click').off('click').on('click', function() {
				$('.nav .responsive').toggleClass('expandable');
			});
			$('ul.menu li a').off('click').on('click', function() {
				$(this).parent('li.parent').toggleClass('active');
				$(this).parent().find('ul.submenu').slideToggle('fast');
				$(this).parent().find('ul.submenu ul.submenu').toggle();
			});
		}
	});
}(jQuery));
