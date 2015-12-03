CKEDITOR.plugins.add( 'relatedItem', {
    requires: 'fakeobjects',
    icons: 'relatedItem',
    onLoad: function() {
        CKEDITOR.addCss( 'img.cke_relatedItem' +
            '{' +
            'background-image: url(' + CKEDITOR.getUrl( this.path + 'icons/relatedItem.png' ) + ');' +
            'background-color: #CCCCCC;' +
            'background-position: center center;' +
            'background-repeat: no-repeat;' +
            'border: 1px solid #a9a9a9;' +
            'min-width: 100px;' +
            'height: 100px;' +
            '}'
        );
    },
    init: function( editor ) {
        editor.addCommand( 'relatedItem', new CKEDITOR.dialogCommand( 'relatedItemDialog', {
            allowedContent: 'relateditem[data-relateditem]',
            requiredContent: 'relateditem'
        }));
        editor.ui.addButton( 'RelatedItem', {
            label: 'Insert Related Item',
            command: 'relatedItem',
            toolbar: 'insert'
        });

        if ( editor.addMenuItems ) {
            editor.addMenuItems( {
                relateditem: {
                    label: 'related item',
                    command: 'relatedItem',
                    group: 'image'
                }
            } );
        }

        if ( editor.contextMenu ) {
            editor.contextMenu.addListener( function( element, selection ) {
                if ( element && element.is( 'img' ) && element.data( 'cke-real-element-type' ) == 'relateditem' )
                    return { relateditem: CKEDITOR.TRISTATE_OFF };
            } );
        }

        CKEDITOR.dialog.add( 'relatedItemDialog', this.path + 'dialogs/relatedItem.js' );
    },
    afterInit: function( editor ) {
        var dataProcessor = editor.dataProcessor,
            dataFilter = dataProcessor && dataProcessor.dataFilter;
        if ( dataFilter ) {
            dataFilter.addRules( {
                elements: {
                    'relateditem': function( element ) {

                        var type = element.attributes["data-relateditem-type"];
                        var width = element.attributes["width"];

                        var fakeElement = editor.createFakeParserElement( element, 'cke_relatedItem', 'relateditem', true );

                        var extraStyles = "";

                        if (element.attributes["data-relateditem-iswide"] == "yes") {
                            extraStyles += "margin-bottom: 15px;";
                        } else {
                            if (element.attributes["align"] == "left") {
                                extraStyles += "margin: 0 10px 10px 0px;";
                            } else {
                                extraStyles += "margin: 0 0 10px 10px;";
                            }
                        }

                        fakeElement.attributes["style"] = extraStyles+"width: "+width+"; background-image: url("+CKEDITOR.getUrl('plugins/relatedItem/icons/'+type+'.png' )+");";

                        return fakeElement;
                    }
                }
            },
            { priority: 5, applyToAll: true } );
        }
    }
});