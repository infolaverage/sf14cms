function breakoutOfFrame(){
    if (top.location != location) {
        top.location.href = document.location.href ;
    }
}

/*
function initLzImages($reinit){
    $selector = $(".j-lz");
    if($reinit){
        $selector = $(".j-lz:not([src]),.j-lz[src^='data']");
    }

    $selector.show().lazyload({
        threshold : 10,
        effect : "fadeIn",
        failure_limit : 1000,
        skip_invisible : false
    });
}
*/

$(document).ready(function(){
    $("a.j-pp[data-rel^='jpp[g]']").prettyPhoto({
        deeplinking     : false,
        social_tools    : ''
    });

    $(".ccnt a.j-pc[data-rel^='jpp[g]']").prettyPhoto({
        deeplinking     : false,
        social_tools    : ''
    });

    //initLzImages(false);
});




