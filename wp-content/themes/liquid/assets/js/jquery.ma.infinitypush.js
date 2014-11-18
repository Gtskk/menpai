/*!
Off Canvas Infinity Push, a infinity push mobile navigation jQuery plugin.

Version 1.0.0
Full source at https://github.com/marc-andrew/off-canvas-infinity-push
Copyright (c) 2014 Marc Andrew http://marcandrew.net/off-canvas-infinity-push

MIT License (http://www.opensource.org/licenses/mit-license.html)
*/

;(function($){

	$.fn.infinitypush = function(options){

		/**
		 * Default options
		 */

		var defaults = {
			offcanvas			: true,
			offcanvasspeed		: 400,
			offcanvasleft		: true,
			openingspeed		: 400,
			closingspeed		: 400,
			spacing				: 90,
			pushdirectionleft	: true,
			autoScroll			: true,
			scrollSpeed			: 300,
			destroy				: false,
			navButton			: '.ma-infinitypush-button'
		};

		var infinityPushWrapper = this;

		var opts = $.extend( {}, defaults, options );

		/**
		 * Start Navigation functions
		 */

		return this.each(function() {

			var oldposition			= $(this).data('oldposition') || $('body'),
				navWrapper			= 'ma-infinitypush-wrapper',
				navWrapperDiv		= '<div class="' + navWrapper + '"></div>',
				navButtonActive		= 'ma-infinitypush-active-button',
				infinityPush		= 'ma-infinitypush',
				infinityPushOpen	= 'ma-infinitypush-open';
			
			function destroy(){
				$(opts.navButton);
				$('.' + infinityPush).unbind();
				$('body').removeClass(infinityPushOpen);
				$('.' + navWrapper).next().removeAttr('style');
				$('.' + navWrapper).find('.ma-infinitypush-inactive').removeClass('ma-infinitypush-inactive');
				$('.' + navWrapper).find('.ma-infinitypush-active-item').removeClass('ma-infinitypush-active-item');
				$('.' + navWrapper).find('.ma-infinitypush-close-subnav').remove();
				$('.' + navWrapper).find('ul').removeAttr('style');
				infinityPushWrapper.prependTo(oldposition);
				infinityPushWrapper.removeClass('ma-infinitypush ma-infinitypush-sub-open');
				$('.' + navWrapper).remove();
				$(this).removeClass(infinityPush);
				infinityPushWrapper.stop().removeAttr('style');
			}
			
			if(opts.destroy){
				if($(this).hasClass(infinityPush))
					destroy();
				return;
			}
			
			if(!$(this).hasClass(infinityPush)){
				
				$(this).data('oldposition', $(this).parent());
				
				// Move navigation after body
				if(!$(this).parent().is('body')) {
					$('body').prepend($(this));
				}

				// Wrapping the element & add new class name
				$(this).before(navWrapperDiv).addClass(infinityPush).appendTo('.' + navWrapper);

				var navWidth	= $('.' + navWrapper).width();

				// Add the mobile menu button
				if(opts.offcanvas == true) {
					
					if(opts.offcanvasleft == true) {
						$('.' + navWrapper).css({ left: '-' + navWidth + 'px' });
						$('.' + navWrapper).addClass('ma-infinitypush-button-left');
					} else {
						$('.' + navWrapper).css({ right: '-' + navWidth + 'px' });
						$('.' + navWrapper).addClass('ma-infinitypush-button-right');
					}

					if(opts.pushdirectionleft == true) {
						$('.' + navWrapper).addClass('ma-infinitypush-left');
					} else {
						$('.' + navWrapper).addClass('ma-infinitypush-right');
					}

					$('.' + navWrapper).addClass(navButtonActive);
					infinityPushToggle();
				}

				// Start navigation toggle function
				function infinityPushToggle() {

					$(opts.navButton).on('click', function(){
					
						if($('body').hasClass(infinityPushOpen)){
							closingAnimation();
						}
						else {
							openingAnimation();
						}
						return false;
					});
				}

				// Start closing animation function
				function closingAnimation() {
					
					if(opts.offcanvasleft == true) {
						$('.' + navWrapper).stop().animate({
							left: '-' + navWidth + 'px'
						}, opts.offcanvasspeed);
					} else {
						$('.' + navWrapper).stop().animate({
							right: '-' + navWidth + 'px'
						}, opts.offcanvasspeed);
					}

					$('.' + infinityPush).stop().animate({
						opacity: 'hide'
					}, opts.offcanvasspeed);

					if(opts.offcanvasleft == true) {
						$('.' + navWrapper).next().stop().animate({
							left: 0
						}, opts.offcanvasspeed);
					} else {
						$('.' + navWrapper).next().stop().animate({
							right: 0
						}, opts.offcanvasspeed);
					}

					$('body').removeClass(infinityPushOpen);

				}

				// Start opening animation
				function openingAnimation() {

					$('body').addClass(infinityPushOpen);

					if(opts.offcanvasleft == true) {
						$('.' + navWrapper).stop().animate({
							left: 0
						}, opts.offcanvasspeed);
					} else {
						$('.' + navWrapper).stop().animate({
							right: 0
						}, opts.offcanvasspeed);
					}

					$('.' + infinityPush).stop().animate({
						opacity: 'show'
					}, opts.offcanvasspeed);

					if(opts.offcanvasleft == true) {
						$('.' + navWrapper).next().stop().animate({
							left: navWidth + 'px'
						}, opts.offcanvasspeed);
					} else {
						$('.' + navWrapper).next().stop().animate({
							right: navWidth + 'px'
						}, opts.offcanvasspeed);
					}

					clickOutside();

				}

				// Start closing function by clicking outside the infinity navigation
				function clickOutside() {
					
					$('.' + infinityPushOpen).on("mousedown touchstart", function (e) {

						if($('.' + infinityPushOpen).length) {
							if (!$('.' + navWrapper).is(e.target) // if the target of the click isn't the container...
								&& $('.' + navWrapper).has(e.target).length === 0) // ... nor a descendant of the container
							{
								closingAnimation();
							}
						}

					});

				}

			}

		});

	};

})(jQuery);


