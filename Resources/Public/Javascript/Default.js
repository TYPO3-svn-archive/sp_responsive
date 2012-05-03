function getMediaOptions(id, prefix) {
	if (typeof id == 'undefined' || id == '' || typeof prefix == 'undefined' || prefix == '') {
		return {};
	}
	id = parseInt(id.substr(id.indexOf(prefix) + prefix.length, id.length));
	var options = spResponsiveSetup[id];
	if (typeof options == 'undefined') {
		options = {};
	}
	return options;
}


jQuery(document).ready(function($) {

		// Make headlines resizable
	if (typeof $.fn.fitText != 'undefined') {
		$('.fittext').each(function(index, element) {
			var $this = $(this);
			var level = $this.attr('data-fittext-level');
			if (typeof level != 'undefined' && level != '') {
				$this.fitText(level);
			} else {
				$this.fitText();
			}
		});
	}

		// Initialize all image sliders
	if (typeof $.flexslider != 'undefined') {
		$('.flexslider').each(function(index, element) {
			var $this = $(this);
			var options = getMediaOptions($this.attr('id'), 'flexslider-');
			$this.flexslider(options);
		});
	}

		// Initialize all image carousels
	if (typeof $.elastislide != 'undefined') {
		$('.es-carousel-wrapper').each(function(index, element) {
			var $this = $(this);
			var options = getMediaOptions($this.attr('id'), 'carousel-');
			$this.elastislide(options);
		});
	}

		// IE < 9 bugfix for linked images in carousel
	if ($.browser.msie && parseInt($.browser.version.slice(0,1)) < 9) {
		$('div.es-carousel a').click(function(event) {
			var url = $(this).attr('href');
			if (typeof url != 'undefined' && url != '') {
				event.preventDefault();
				window.location = url;
			}
		});
	}

});