( function() {
    var checkboxValues = {
        "data-relateditem-iswide": { 'true': 'yes', 'false': 'no' },
        "copy_to_all": { 'true': 'yes', 'false': 'no' }
    };

    var itemIds = {};
    var itemCounters = {};
    var newElement = false;

    function processItemIds(editorName, oldType, type, oldId, itemId, isNew) {
        if (itemIds[editorName] == undefined) itemIds[editorName] = [];
        if (itemIds[editorName][type] == undefined) itemIds[editorName][type] = [];
        if (isNew) {
            if (itemIds[editorName][type].length == 0) {
                itemIds[editorName][type].push(itemId);
            } else {
                var in_array = false;
                for (var i = 0; i < itemIds[editorName][type].length; i++) {
                    if (itemIds[editorName][type][i] == itemId) {
                        in_array = true;
                    }
                }
                if (!in_array) {
                    itemIds[editorName][type].push(itemId);
                }
            }
        } else {
            if (oldType != undefined) {
                if (itemIds[editorName][oldType] == undefined) itemIds[editorName][oldType] = [];
                for (var i = 0; i < itemIds[editorName][oldType].length; i++) {
                    if (itemIds[editorName][oldType][i] == oldId) {
                        itemIds[editorName][oldType].splice(i, 1);
                    }
                }
            }
            var in_array = false;
            for (var i = 0; i < itemIds[editorName][type].length; i++) {
                if (itemIds[editorName][type][i] == itemId) {
                    in_array = true;
                }
            }
            if (!in_array) {
                itemIds[editorName][type].push(itemId);
            }
        }
    }

    function loadValue( iframeNode ) {
        var isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox;
        if ( iframeNode.hasAttribute( this.id ) ) {
            var value = iframeNode.getAttribute( this.id );
            if ( isCheckbox )
                this.setValue( checkboxValues[ this.id ][ 'true' ] == value.toLowerCase() );
            else
                this.setValue( value );
        }
    }

    function loadRelated(iframeNode) {

        var element = $('#' + this.getInputElement().$.id);
        var value;

        if (typeof iframeNode.hasAttribute === 'function') {
            if ( iframeNode.hasAttribute( this.id ) ) {
                value = iframeNode.getAttribute( this.id);
                value = value.split("#")[0];
            }
        }

        element.html('');

        $.ajax({
            url: $('#autocomplete_url').val(),
            dataType: 'json',
            success: function(data) {
                for (var i in data) {
                    var optgroup = $('<optgroup label="' + i + '">');
                    for (var option in data[i]) {
                        var isSel = "";
                        if (value == data[i][option].id) {
                            isSel = 'selected="selected"'
                        }
                        optgroup.append('<option value="' + data[i][option].id + '" '+isSel+'>' + data[i][option].value + '</option>');
                    }
                    element.append(optgroup);
                }
            }
        });
    }

    function commitValue( iframeNode ) {
        var isRemove = this.getValue() === '',
            isCheckbox = this instanceof CKEDITOR.ui.dialog.checkbox,
            value = this.getValue();
        if ( isRemove ) {
            iframeNode.removeAttribute( this.att || this.id );
        } else if ( isCheckbox ) {
            switch (this.id) {
                case "data-relateditem-iswide":
                    iframeNode.setAttribute( this.id, checkboxValues[ this.id ][ value ] );

                    if (checkboxValues[ this.id ][ value ] == "yes") {
                        iframeNode.setAttribute('width', '100%');
                    } else {
                        iframeNode.setAttribute('width', 'auto');
                    }
                    break;
                case "copy_to_all":
                    if (checkboxValues[ this.id ][ value ] == "yes") {


                    }
                    break;
            }
        } else {
            var element = $('#' + this.getInputElement().$.id);
            var oldType;
            if (!newElement) {
                oldType = iframeNode.getAttribute( "data-relateditem-type");
            }

            var type = $(':selected', element).closest('optgroup').attr('label');
            if (type) {
                iframeNode.setAttribute( "data-relateditem-type", type );
            }

            var newValue;

            if (this.id == "data-relateditem-id") {
                var currentEditorName;
                for(var id in CKEDITOR.instances) {
                    if (CKEDITOR.instances[id].focusManager.hasFocus) {
                        currentEditorName = id;
                    }
                }

                if (itemIds[currentEditorName] == undefined) itemIds[currentEditorName] = [];
                if (itemIds[currentEditorName][type] == undefined) itemIds[currentEditorName][type] = [];

                if (itemCounters[type] == undefined) itemCounters[type] = 0;
                if (newElement) {
                    itemCounters[type]++;
                    newValue = value+"#"+itemCounters[type];
                } else {
                    if (oldType != type) {
                        itemCounters[type]++;
                        newValue = value+"#"+itemCounters[type];
                    } else {
                        var counter = iframeNode.getAttribute("data-relateditem-id").split("#");
                        newValue = value+"#"+counter[1];
                    }
                }

            } else {
                newValue = value;
            }

            iframeNode.setAttribute( this.att || this.id, newValue);

        }
    }

    CKEDITOR.dialog.add( 'relatedItemDialog', function( editor ) {
        var commonLang = editor.lang.common;
        return {
            title: 'Related Item',
            minWidth: 400,
            minHeight: 200,
            contents: [
                {
                    id: 'tab-basic',
                    label: 'Basic Settings',
                    elements: [
                        {
                            type: 'select',
                            id: 'data-relateditem-id',
                            label: 'Kapcsolódó elem',
                            items: [],
                            validate: CKEDITOR.dialog.validate.notEmpty( "Please select a related item." ),
                            setup: loadRelated,
                            onLoad: loadRelated,
                            commit: commitValue
                        },
                        {
                            id: 'align',
                            type: 'select',
                            requiredContent: 'relatedItem[align]',
                            'default': 'left',
                            items: [
                                [ commonLang.alignLeft, 'left' ],
                                [ commonLang.alignRight, 'right' ]
                            ],
                            style: 'width:100%',
                            labelLayout: 'vertical',
                            label: commonLang.align,
                            setup: function( iframeNode, fakeImage ) {
                                loadValue.apply( this, arguments );
                                if ( fakeImage ) {
                                    var fakeImageAlign = fakeImage.getAttribute( 'align' );
                                    this.setValue( fakeImageAlign && fakeImageAlign.toLowerCase() || '' );
                                }
                            },
                            commit: function( iframeNode ) {
                                commitValue.apply( this, arguments );
                                //, extraStyles, extraAttributes
                                /*if ( this.getValue() )
                                    extraAttributes.align = this.getValue();*/
                            }
                        },
                        {
                            type: 'checkbox',
                            id: "data-relateditem-iswide",
                            label: "Teljes szélességű",
                            setup: loadValue,
                            commit: commitValue
                        }/*,
                        {
                            type: 'checkbox',
                            id: "copy_to_all",
                            label: "Másolás a többi nyelvre",
                            default: true,
                            setup: loadValue,
                            commit: commitValue
                        }*/
                    ]
                }
            ],
            onShow: function() {
                // Clear previously saved elements.
                this.fakeImage = this.iframeNode = null;

                var fakeImage = this.getSelectedElement();

                if ( fakeImage && fakeImage.data( 'cke-real-element-type' ) && fakeImage.data( 'cke-real-element-type' ) == 'relateditem' ) {
                    this.fakeImage = fakeImage;

                    var iframeNode = editor.restoreRealElement( fakeImage );
                    this.iframeNode = iframeNode;

                    this.setupContent( iframeNode );
                }
            },
            onOk: function() {
                var iframeNode, isNew = false, oldHtml, oldType, oldId;
                if ( !this.fakeImage ) {
                    iframeNode = new CKEDITOR.dom.element( 'relateditem' );
                    isNew = true;
                    newElement = true;
                } else {
                    newElement = false;
                    iframeNode = this.iframeNode;
                    oldHtml = iframeNode.$.outerHTML;
                    oldType = iframeNode.getAttribute("data-relateditem-type");
                    oldId = iframeNode.getAttribute("data-relateditem-id");
                }

                // A subset of the specified attributes/styles
                // should also be applied on the fake element to
                // have better visual effect. (#5240)

                var extraStyles = {}, extraAttributes = {};

                this.commitContent( iframeNode );
                if (iframeNode.getAttribute("data-relateditem-iswide") == "yes") {
                    extraStyles["margin-bottom"] = "15px";
                } else {
                    if (iframeNode.getAttribute("align") == "left") {
                        extraStyles["margin"] = "0 10px 10px 0px";
                    } else {
                        extraStyles["margin"] = "0 0 10px 10px";
                    }
                }

                extraStyles["background-image"] = "url("+CKEDITOR.getUrl('plugins/relatedItem/icons/'+iframeNode.getAttribute("data-relateditem-type")+'.png' )+")";

                // Refresh the fake image.
                var newFakeImage = editor.createFakeElement( iframeNode, 'cke_relatedItem', 'relateditem', true );
                newFakeImage.setAttributes( extraAttributes );
                newFakeImage.setStyles( extraStyles );
                if ( this.fakeImage ) {
                    newFakeImage.replace( this.fakeImage );
                    editor.getSelection().selectElement( newFakeImage );
                } else
                    editor.insertElement( newFakeImage );

                //var isCopy = this.getValueOf( 'tab-basic', 'copy_to_all' );
                var type = iframeNode.getAttribute("data-relateditem-type");
                var itemId = iframeNode.getAttribute("data-relateditem-id");

                var currentEditorName;
                for(var id in CKEDITOR.instances) {
                    if (CKEDITOR.instances[id].focusManager.hasFocus) {
                        currentEditorName = id;
                    }
                }

                var content = CKEDITOR.instances[currentEditorName].getData();

                var relatedItemHtml = iframeNode.$.outerHTML;
                var position = content.indexOf(relatedItemHtml);

                var closedPBeforeInSource = (content.substr(0, position).match(/<\/p>/g) || []).length;
                console.log("p before: "+closedPBeforeInSource);
                if (false) {
                //if (checkboxValues["copy_to_all"][isCopy] == "yes") {

                    $("textarea").filter(function(){
                        var nameSplit = currentEditorName.split(/_[a-z]{2}_/);
                        var pattern = nameSplit[0]+'_[a-z]{2}_'+nameSplit[1];
                        var regExp = new RegExp(pattern);

                        return this.id.match(regExp);
                    }).each(function(i) {

                        var currentText;
                        var isEditor = false;
                        if (CKEDITOR.instances[$(this).attr("id")] == undefined) {
                            currentText = $(this).val();
                        } else {
                            isEditor = true;
                            currentText = CKEDITOR.instances[$(this).attr("id")].getData();
                        }

                        if (currentText != "") {    
                            //console.log(oldType);
                            //processItemIds($(this).attr("id"), oldType, type, oldId, itemId, isNew);
                        }

                        if ($(this).attr("id") != currentEditorName && currentText != "") {

                            var itempattern = 'data-relateditem-id="'+itemId+'"\\sdata-relateditem-type="'+type+'"';
                            var itemRegexp = new RegExp(itempattern, "g");
                            var matches = currentText.match(itemRegexp);

                            if (matches) {
                            } else {

                                if (!isNew && oldType != type && oldId != itemId) {
                                    var replacepattern = '<relateditem\\swidth=".*"\\sdata-relateditem-iswide=".*"\\salign=".*"\\sdata-relateditem-id="'+oldId+'"\\sdata-relateditem-type="'+oldType+'"></relateditem>';
                                    var replaceRegexp = new RegExp(replacepattern, "g");
                                    var itemmatches = currentText.match(replaceRegexp);

                                    currentText = currentText.replace(replaceRegexp, "");
                                }
                                
                                position = content.indexOf(relatedItemHtml);

                                var closedPBefore = (currentText.substr(0, position).match(/<\/p>/g) || []).length;

                                var pRe = new RegExp('</p>', 'ig');
                                //pMatches = pRe.exec(currentText);
                                var pMatches = [];
                                while (match = pRe.exec(currentText)) {
                                    //var matchArray = [];
                                    for (i in match) {
                                        if (parseInt(i) == i) {
                                            pMatches.push(match.index);
                                        }
                                    }
                                    //pMatches.push(matchArray);
                                }

                                if (closedPBeforeInSource > pMatches.length) {
                                    position = pMatches[pMatches.length - 1] + 4;
                                } else {
                                    position = pMatches[closedPBeforeInSource] + 4;
                                }

                                //console.log(pMatches);
                                //position = pRe.lastIndex + 1;
                                //console.log($(this).attr("id")+' - '+position);
                                /*var openingCountBefore = (currentText.substr(0, position).match(/</g) || []).length;
                                var closingCountBefore = (currentText.substr(0, position).match(/>/g) || []).length;

                                if (openingCountBefore > closingCountBefore) {
                                    position = currentText.substr(0, position).lastIndexOf('>')+1;
                                    position = currentText.indexOf(" ", position);
                                }

                                var ampCountBefore = (currentText.substr(0, position).match(/&(a|i|u|o|e|s|n|l|g|c|ae|y|th)+/ig) || []).length;
                                var semicolonCountBefore = (currentText.substr(0, position).match(/(orn|slash|th|bsp|mp|uml|acute|caron|t|grave|circ|tilde|ring|lig|cedil)+;/ig) || []).length;

                                if (ampCountBefore > semicolonCountBefore) {
                                    position = currentText.substr(0, position).lastIndexOf(';')+1;
                                    position = currentText.indexOf(" ", position);
                                }*/

                                if (position == -1) {
                                    position = 0;
                                }

                                var finalText = currentText.substr(0, position) + relatedItemHtml + currentText.substr(position);
                                if (isEditor) {
                                    CKEDITOR.instances[$(this).attr("id")].setData(finalText);
                                } else {
                                    $(this).val(finalText);
                                }
                            }
                        }
                    });
                } else {
                    //processItemIds(currentEditorName, oldType, type, oldId, itemId, isNew);
                }

                console.log(itemIds);
            }
        };
    });
} )();