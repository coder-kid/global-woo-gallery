;(function($) {

    /**
     * The main metabox interface class
     * 
     * @since	1.0.0
     * @class GWPG_MBT
     */
    GWPG_MBT = {

        /**
         * Initialize the meta box interfrace.
         * 
         * @since	1.0.0
         * @access	private
         * @method	_init
         */
        _init: function() {
            GWPG_MBT._initTabs();
        },

        /**
         * Initialize metabox tabs.
         * 
         * @access private
         * @method	_initTabs
         */
        _initTabs: function() {
            
            // Tabs
            var navEl = $('.gwpg-metabox-tabs'),
                container	= $(navEl.data('container')),
                tabHash	= window.location.hash,
                currentTab = window.location.hash.replace( '!', '' );

            if(tabHash && tabHash.indexOf('gwpg-metabox-tab-') >= 0 ) {

                // Remove the active class from everything in this tab navigation and section.
                container.find('.gwpg-metabox-tab-content').removeClass('active');
                navEl.find('.gwpg-metabox-tab').removeClass('active');

                // Add the active class to the chosen tab and section
                $(currentTab).addClass('active');
                navEl.find('a[href="'+currentTab+'"]').parent().addClass('active');


                // Update the form action to contain the selected tab as a hash in the URL
                // This means when the user saves their Giveaway, they'll see the last selected
                // tab 'open' on reload.
                var postAction = $('#post').attr('action');
                if ( postAction ) {
                    // Remove any existing hash from the post action.
                    postAction = postAction.split('#')[0];

                    // Append the selected tab as a hash to the post action.
                    $( '#post' ).attr( 'action', postAction + window.location.hash );
                }

            }

            navEl.find('a').on('click', function(e) {
                e.preventDefault();

                // Remove the active class from everything in this tab navigation and section.
                container.find('.gwpg-metabox-tab-content').removeClass('active');
                navEl.find('.gwpg-metabox-tab').removeClass('active');

                // Get the nav tab ID.
                var tabId = $(this).attr('href');

                // Add the active class to the chosen tab and section.
                $(tabId).addClass('active');
                $(this).parent().addClass('active');
                
                // Trigger tab change hook.
				$('body').trigger('gwpg-tab-change', this);

                // Update the window URL to contain the selected tab as a hash in the URL.
                window.location.hash = tabId.split('#').join('#!');

                // Update the form action to contain the selected tab as a hash in the URL
                // This means when the user saves their Giveaway, they'll see the last selected
                // tab 'open' on reload.
                var postAction = $('#post').attr('action');
                if ( postAction ) {
                    // Remove any existing hash from the post action.
                    postAction = postAction.split('#')[0];

                    // Append the selected tab as a hash to the post action.
                    $( '#post' ).attr( 'action', postAction + window.location.hash );
                }

            });

        }

    };

    $(document).ready(function() {
        //Initialize GWPG_MBT
        GWPG_MBT._init();
    });

})(jQuery);