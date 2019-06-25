(function () {
    tinymce.PluginManager.add('gwpg_mce_button', function (editor, url) {
        editor.addButton('gwpg_mce_button', {
            text: false,
            icon: false,
            image: url + '/icon.png',
            tooltip: 'Global Product Gallery',
            onclick: function () {
                editor.windowManager.open({
                    title: 'Insert Shortcode',
                    width: 400,
                    height: 100,
                    body: [
                        {
                            type: 'listbox',
                            name: 'listboxName',
                            label: 'Select Shortcode',
                            'values': editor.settings.GWPGShortcodeList
                        }
                    ],
                    onsubmit: function (e) {
                        editor.insertContent('[gwpg-gallery id="' + e.data.listboxName + '"]');
                    }
                });
            }
        });
    });
})();