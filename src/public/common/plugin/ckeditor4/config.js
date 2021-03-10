/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.editorConfig = function (config) {
    config.language = 'vi';
    config.width = '100%';
    config.height = 500;

    config.entities_latin = false;

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
    // config.removePlugins = 'easyimage, cloudservices';
};
