CKEDITOR.stylesSet.add( 'my_styles', [
    // Block-level styles.
    { name: 'Alap bekezdés',    element: 'p', attributes: { 'class': '' } },
    { name: 'P1',    element: 'p', attributes: { 'class': 'p-1' } },
    { name: 'P2',    element: 'p', attributes: { 'class': 'p-2' } },
    { name: 'Clearfix',    element: 'p', attributes: { 'class': 'clearfix' } },
    { name: 'P Separator',    element: 'p', attributes: { 'class': 'sep-1' } },
    { name: 'P Separator A',    element: 'p', attributes: { 'class': 'sep-1-a' } },
    { name: '.H1',    element: 'p', attributes: { 'class': 'h1' } },
    { name: '.H2',    element: 'p', attributes: { 'class': 'h2' } },
    //{ name: 'Bevezető',         element: 'p', attributes: { 'class': 'lead' } },
    //{ name: 'Kiemelt szöveg',   element: 'p', attributes: { 'class': 'format-type-1' } },
    //{ name: 'Felső index',      element: 'span', attributes: { 'class': 'superscript' } },
    //{ name: 'Idézet',           element: 'p', attributes: { 'class': 'quote' } },
    //{ name: 'Kérdés',           element: 'p', attributes: { 'class': 'question' } },
    //{ name: 'Kép balra',        element: 'img', attributes: { 'class': 'image-left' } },
    //{ name: 'Kép középen',      element: 'img', attributes: { 'class': 'image-center' } },
    //{ name: 'Kép jobbra',       element: 'img', attributes: { 'class': 'image-right' } }
    //{ name: '',       element: 'img', attributes: { 'class': 'image-right' } }

    //inline styles
    /*
    { name: 'imageleft', element: 'p', attributes: { 'class': 'image-left' } },
    { name: 'imagecenter', element: 'p', attributes: { 'class': 'image-center' } },
    { name: 'imageright', element: 'p', attributes: { 'class': 'image-right' } },
    */
]);

CKEDITOR.editorConfig = function( config ) {
    config.height   = 500;
    config.width    = 796;
    config.toolbar = [
        {name: 'document', items: ['Save', 'Source']},
        /*{name: 'basicstyles', items: ['Bold', 'Italic', 'Underline']},*/
        {name: 'basicstyles', items: ['Bold']},
        {name: 'paragraph', items: ['NumberedList', 'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'/*, 'Outdent', 'Indent', */]},
        /*{name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Outdent', 'Indent', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},*/
        {name: 'links', items: ['Link', 'Unlink'/*, 'Anchor'*/]},
        {name: 'insert', items: ['Image', 'Table', /*'HorizontalRule',*/ 'SpecialChar', /*'PageBreak', 'Iframe',*/ 'RelatedItem']},
        '/',
        {name: 'styles', items: ['Styles', 'Format']}
    ];

    config.format_tags      = 'p;h1;h2';
    config.bodyClass        = 'ccnt';
    //config.extraPlugins     = 'relatedItem,wordcount';
    config.allowedContent   = true;
    config.fillEmptyBlocks  = false;

    config.stylesSet        = 'my_styles';
    config.contentsCss      = [
        '/resources_core/bootstrap_core/css/bootstrap.css',
        '/resources/css/fonts.css',
        '/resources/css/ccnt.css',
    ];


    config.filebrowserBrowseUrl         = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl    = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl    = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl         = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl    = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl    = '/resources_core/backend_core/plugins_153sfhAbx/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

    config.entities_latin = true;
    //config.entities = true;

    //config.entities_additional = '&#369;';

    /*
    config.coreStyles_underline = {
        element: 'span',
        attributes: { 'class': 'underline' }
    }
    */

    /*config.justifyClasses = [ 'align-left', 'align-center', 'align-right', 'align-justify' ];*/

}