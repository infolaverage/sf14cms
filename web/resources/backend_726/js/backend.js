$(document).ready(function(){
    $('.j-ckeditor-default', $(this)).each(function(){

        //console.log($(this).attr("id") + " >> " + $(this).attr('data-ckeconfig'));

        CKEDITOR.replace($(this).attr("id"), {
            customConfig: $(this).data('ckeconfig')
        });

    });
});
