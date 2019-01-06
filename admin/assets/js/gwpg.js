;(function($) {
    /**
     * GWPG Admin Script
     * @since	1.0.0
     */
    GWPG_Admin = {

        /**
		 * Initialize the functions.
		 * 
		 * @method _init
		 * @access private
		 */
		_init: function() {
			GWPG_Admin._initTabs();
			GWPG_Admin._bindEvents();
			GWPG_Admin._prettySelect();
			GWPG_Admin._rangeSliderControl();
		},
		
		/**
         * Range slider value control
		 * 
		 * @method _rangeSliderControl
		 * @access private
         */
        _rangeSliderControl: function() {
            var slider = $('.range-slider')
                range  = $('.range-slider__range'),
				value  = $('.range-slider__value');

			slider.each(function() {
				
				value.each(function() {
					var suffix = ($(this).prev().attr('suffix')) ? $(this).prev().attr('suffix') : '';
					var value = $(this).prev().attr('value');
					$(this).html(value + suffix);
				});

				range.on('input', function() {
					var suffix = ($(this).attr('suffix')) ? $(this).attr('suffix') : '';
					$(this).next(value).html(this.value + suffix );
				});
				
			});
        },
        
        /**
		 * Initialize metabox tabs.
		 * 
		 * @method _initTabs
		 * @access private
		 */
		_initTabs: function()
		{
			var tabLength = ($('.gwpg-metabox-tab').length) - 1,
				$cl       = (window.location.hash);

			if( ($('.gwpg-metabox-tab.active').next().length === 0) || $cl == '#!gwpg-metabox-tab-gopro' ) {
				$('.gwpg-metabox-next-tab').hide();
				$('.gwpg-metabox-save-config').css('display', 'inline-block');
			}

        },
        
        /**
		 * Bind events.
		 * 
		 * @method _bindEvents
		 * @access private
		 */
		_bindEvents: function()
		{
            $('body').on('click', '.gwpg-metabox-next-tab', GWPG_Admin._nextButtonClicked);
			$('body').on('click', '.gwpg-metabox-save-config', GWPG_Admin._saveButtonClicked);
			$('body').on('gwpg-tab-change', GWPG_Admin._tabChange);
        },

        /**
		 * Trigger events Next tab button clicked.
		 * 
		 * @param {Object} event
		 * @method _nextButtonClicked
		 * @access private
		 */
		_nextButtonClicked: function(e)
		{
			e.preventDefault();
			if ( $('li.gwpg-metabox-tab.active').next().length > 0 ) {
				$('li.gwpg-metabox-tab.active').next().find('a').trigger('click');
			}
		},

		/**
		 * Trigger events on Save button clicked.
		 * 
		 * @param {Object} event
		 * @method _saveButtonClicked
		 * @access private
		 */
		_saveButtonClicked: function(e)
		{
			e.preventDefault();

			$(this).addClass('disabled');
			$(this).text( $(this).data('saving') );

			$('input#publish').trigger('click');
		},
        
        /**
		 * Show next or save button when tab has switched manually.
		 * 
		 * @param {Object} event
		 * @param {String} target
		 * @method _tabChange
		 * @access private
		 */
		_tabChange: function(e, target)
		{
			if ( $(target).parent().next().length > 0 ) {
				$('.gwpg-metabox-next-tab').css('display', 'inline-block');
				$('.gwpg-metabox-save-config').hide();
			} else {
				$('.gwpg-metabox-next-tab').hide();
				$('.gwpg-metabox-save-config').css('display', 'inline-block');
			}
		},

		/**
		 * Initialize select2 js on metabox select fields
		 * 
		 * @method _prettySelect
		 * @access private
		 */
		_prettySelect: function() {
			if($.fn.select2) {
				$('.gwpg-metabox-select').select2({
					width: 'resolve' // need to override the changed default
				});
			}
		}

    };

    $(document).ready(function() {
        GWPG_Admin._init();
    });
    
})(jQuery);