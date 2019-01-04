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
        },
        
        /**
		 * Initialize metabox tabs.
		 * 
		 * @method _initTabs
		 * @access private
		 */
		_initTabs: function()
		{
			if(
				($('.gwpg-metabox-tab.active').next().length === 0)
				|| (window.location.hash === '#!gwpg-metabox-tab-gopro')
			) {
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
				$('.gwpg-metabox-select').select2();
			}
		}

    };

    $(document).ready(function() {
        GWPG_Admin._init();
    });
    
})(jQuery);