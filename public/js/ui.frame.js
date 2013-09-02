/*
 * jQuery UI Frame (based on jQuery UI dialog)
 *
 * Agile Technologies
 *
 * Depends:
 *	jquery.ui.dialog.js
 */
(function($) {




$.widget("ui.frame", $.ui.dialog, {

_create: function() {
		this.originalTitle = this.element.attr('title');

		this.options.width=900;
		this.options.minHeight=350;
		this.options.hide='fast';

		var self = this,
			options = self.options,

			title = options.title || self.originalTitle || '&#160;',
			titleId = $.ui.dialog.getTitleId(self.element),

			/*

<div id="fancybox-inner" style="top: 10px; left: 10px; width: 880px; height: 64px; overflow-x: auto; overflow-y: auto; "><div id="data" style="max-width:880px">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div></div><a id="fancybox-close" style="display: inline; "></a><a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a><a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a><div id="fancybox-title" class="fancybox-title-outside" style="width: 880px; padding-left: 10px; padding-right: 10px; bottom: -51px; display: block; "><span id="fancybox-title-wrap"><span id="fancybox-title-left"></span><span id="fancybox-title-main">IIA Congress</span><span id="fancybox-title-right"></span></span></div></div>

	*/


			uiDialog = (self.uiDialog = $('<div id="fancybox-wrap" style="width: 900px; height: 700px; display: block"><div id="fancybox-outer"><div class="fancy-bg" id="fancy-bg-n"></div><div class="fancy-bg" id="fancy-bg-ne"></div><div class="fancy-bg" id="fancy-bg-e"></div><div class="fancy-bg" id="fancy-bg-se"></div><div class="fancy-bg" id="fancy-bg-s"></div><div class="fancy-bg" id="fancy-bg-sw"></div><div class="fancy-bg" id="fancy-bg-w"></div><div class="fancy-bg" id="fancy-bg-nw"></div><div id="fancybox-inner" style="top: 10px; left: 10px; width: 880px; height: 680px; overflow-x: auto; overflow-y: auto; "></div>'))
				.appendTo(document.body)
				.hide()
				.addClass(options.dialogClass)
				.css({
					zIndex: options.zIndex
				})
				// setting tabIndex makes the div focusable
				// setting outline to 0 prevents a border on focus in Mozilla
				.attr('tabIndex', -1).css('outline', 0).keydown(function(event) {
					if (options.closeOnEscape && event.keyCode &&
						event.keyCode === $.ui.keyCode.ESCAPE) {
						
						self.close(event);
						event.preventDefault();
					}
				})
				.attr({
					role: 'dialog',
					'aria-labelledby': titleId
				})
				.mousedown(function(event) {
					self.moveToTop(false, event);
				}),

			uiDialogContent = self.element
				.show()
				.removeAttr('title')
				.attr('id','data')
				.css({
						})
				.appendTo(uiDialog.find('#fancybox-inner')),


			uiDialogTitlebarClose = $('<a href="#"></a>')
				.attr('id','fancybox-close')
				.css({'display':'inline'})
				.attr('role', 'button')
				/*
				.hover(
					function() {
						uiDialogTitlebarClose.addClass('ui-state-hover');
					},
					function() {
						uiDialogTitlebarClose.removeClass('ui-state-hover');
					}
				)
				.focus(function() {
					uiDialogTitlebarClose.addClass('ui-state-focus');
				})
				.blur(function() {
					uiDialogTitlebarClose.removeClass('ui-state-focus');
				})
				*/
				.click(function(event) {
					self.close(event);
					return false;
				})
				.appendTo(uiDialog.find('#fancybox-outer')),

			uiDialogTitlebar = (self.uiDialogTitlebar = $('<div id="fancybox-title" style="width: 880px; padding-left: 10px; padding-right: 10px; bottom: -51px; display: block; "><span id="fancybox-title-wrap"></span></div>'))
				.appendTo(uiDialog.find('#fancybox-outer')),

			uiDialogTitle = $('<span></span>')
				.attr('id', 'fancybox-title-left')
				.appendTo(uiDialogTitlebar.find('#fancybox-title-wrap'));

			uiDialogTitle = $('<span></span>')
				//.attr('id', titleId)
				.attr('id', 'fancybox-title-main')
				.html(title)
				.appendTo(uiDialogTitlebar.find('#fancybox-title-wrap'));

			uiDialogTitle = $('<span></span>')
				.attr('id', 'fancybox-title-right')
				.appendTo(uiDialogTitlebar.find('#fancybox-title-wrap'));


			$(window).bind("resize.fb", function(){ self._position() });
			$(window).bind("scroll.fb", function(){ self._position() });



		//handling of deprecated beforeclose (vs beforeClose) option
		//Ticket #4669 http://dev.jqueryui.com/ticket/4669
		//TODO: remove in 1.9pre
		if ($.isFunction(options.beforeclose) && !$.isFunction(options.beforeClose)) {
			options.beforeClose = options.beforeclose;
		}

		uiDialogTitlebar.find("*").add(uiDialogTitlebar).disableSelection();

		/*
		if (options.draggable && $.fn.draggable) {
			self._makeDraggable();
		}
		/*
		if (options.resizable && $.fn.resizable) {
			self._makeResizable();
		}
		*/

		//self._createButtons(options.buttons);
		self._isOpen = false;

		if ($.fn.bgiframe) {
			uiDialog.bgiframe();
		}
	},

	open: function() {
		if (this._isOpen) { return; }

		var self = this,
			options = self.options,
			uiDialog = self.uiDialog;

		self.overlay = options.modal ? new $.ui.dialog.overlay(self) : null;
		if (uiDialog.next().length) {
			uiDialog.appendTo('body');
		}
		self._size();
		self._position(options.position);
		uiDialog.addClass('zoom_animation');
		uiDialog.show(options.show);

		self.moveToTop(true);

		// prevent tabbing out of modal dialogs
		if (options.modal) {
			uiDialog.bind('keypress.ui-dialog', function(event) {
				if (event.keyCode !== $.ui.keyCode.TAB) {
					return;
				}
	
				var tabbables = $(':tabbable', this),
					first = tabbables.filter(':first'),
					last  = tabbables.filter(':last');
	
				if (event.target === last[0] && !event.shiftKey) {
					first.focus(1);
					return false;
				} else if (event.target === first[0] && event.shiftKey) {
					last.focus(1);
					return false;
				}
			});
		}

		// set focus to the first tabbable element in the content area or the first button
		// if there are no tabbable elements, set focus on the dialog itself
		$([])
			.add(uiDialog.find('.ui-dialog-content :tabbable:first'))
			.add(uiDialog.find('.ui-dialog-buttonpane :tabbable:first'))
			.add(uiDialog)
			.filter(':first')
			.focus();

		self._trigger('open');
		self._isOpen = true;

		return self;
	},







			 /*
	_position: function(position) {
		this.uiDialog
			// workaround for jQuery bug #5781 http://dev.jquery.com/ticket/5781
			.css({ top: 0, left: 0 })
			.position({
				of: window,
				my: "center center",
				at: "center center",
				collision: 'fit',
				// ensure that the titlebar is never outside the document
				using: function(pos) {
					var topOffset = $(this).css(pos).offset().top;
					if (topOffset < 0) {
						$(this).css('top', pos.top - topOffset);
					}
				}
			});

	},
	*/
	_size: function(position) {
	}
});
}(jQuery));
