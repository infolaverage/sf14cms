// Create the tooltips only when document ready
$(document).ready(function () {


    // ----------------------- SIMPLE TITLE TEXT------------------------------------------ //
	$('a.titleTooltip[title]').qtip({
    
	position: {
        my: 'bottom center',  // Position my top left...
        at: 'top center', // at the bottom right of...
      //  target: $('a.titleTootlip[title]') // my target
    },
	
	show: {
		delay: 300,
        effect: function(offset) {
            $(this).fadeToggle("400","swing"); // "this" refers to the tooltip
        }
    },

	 hide: {
        effect: function(offset) {
            $(this).slideUp(200); // "this" refers to the tooltip
        }
    },
	
	style: {
        classes: 'qtip-bootstrap'
    }
	
});

    // --------------------- INLINE HTML -------------------------------------------- //
    $('a.htmlTooltip').each(function() {
     $(this).qtip({

         content: {
             text: $(this).next('.tooltiptext')
         },

         show: {
             delay: 300,
             effect: function(offset) {
                 $(this).fadeToggle("400","swing"); // "this" refers to the tooltip
             }
         },

         hide: {
             effect: function(offset) {
                 $(this).slideUp(200); // "this" refers to the tooltip
             }
         },

        position: {
        my: 'bottom center',  // Position my top left...
        at: 'top center', // at the bottom right of...
        // target: $('a.htmlTootlip') // my target
        },

         style: {
             classes: 'qtip-bootstrap'
         }

     });
    });



    // ----------------- ONLY CART MODUL --------------------------------- //
     $('a.cartTooltip').each(function() {
         $(this).qtip({
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href') // Use href attribute as URL
                    })
                    .then(function(content) {
                        // Set the tooltip content upon successful retrieval
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        // Upon failure... set the tooltip content to error
                        api.set('content.text', status + ': ' + error);
                    });
        
                    return 'Töltés...'; // Set some initial text
                }
            },

             position: {
                 my: 'top center',  // Position my top left...
                 at: 'bottom center', // at the bottom right of...
                 //  target: $('a.titleTootlip[title]') // my target
             },

             show: {
                 delay: 300,
                 effect: function(offset) {
                     $(this).fadeToggle(400); // "this" refers to the tooltip
                 }
             },

             hide: {
                 event: 'unfocus',

                 effect: function(offset) {
                     $(this).slideUp(200); // "this" refers to the tooltip
                 }
             },

             style: {
                 classes: 'qtip-cart qtip-bootstrap'
             }

         });
     });



    // ----------------- AJAX --------------------------------- //
    $('a.ajaxTooltip').each(function() {
        $(this).qtip({
            content: {
                text: function(event, api) {
                    $.ajax({
                        url: api.elements.target.attr('href') // Use href attribute as URL
                    })
                        .then(function(content) {
                            // Set the tooltip content upon successful retrieval
                            api.set('content.text', content);
                        }, function(xhr, status, error) {
                            // Upon failure... set the tooltip content to error
                            api.set('content.text', status + ': ' + error);
                        });

                    return 'Töltés...'; // Set some initial text
                }
            },


            position: {
                my: 'top center',  // Position my top left...
                at: 'bottom center', // at the bottom right of...
                //  target: $('a.titleTootlip[title]') // my target
            },

            show: {
                delay: 300,
                effect: function(offset) {
                    $(this).fadeToggle(400); // "this" refers to the tooltip
                }
            },

            hide: {
                    effect: function(offset) {
                    $(this).slideUp(200); // "this" refers to the tooltip
                }
            },

            style: {
                classes: 'qtip-bootstrap'
            }

        });
    });


});
