/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

'use strict';

; (function ($, window, document, undefined) {
	$('.inputfile').each(function () {
		let $input = $(this);
		let $label = $input.next('label');
		let labelVal = $label.html();

		$input.on('change', function (e) {
			let fileName = '';
			if (e.target.value) fileName = e.target.value.split('\\').pop();
			
			if (fileName) {
				$label.find('span').html(fileName); {
				}
			} else {
				$label.html(labelVal);
			}
		});
	});
})(jQuery, window, document);