<?php

    $partial = null;
    switch($type){
        case "openpage-slider":
            $partial = "banner/type/openpageSlider";
            break;
        case "column-banner":
        case "column-banner-1":
        case "column-banner-2":
            $partial = "banner/type/columnBanner";
            break;
        case "column-banner-3":
            $partial = "banner/type/columnBannerClean";
            break;
        //case "column-alternate":
            //$partial = "type/openpageSlider";
            //$partial = "banner/type/openpageSlider";
        //    break;
    }

    if(!is_null($partial) && $entities){
        //echo $partial;
        include_partial(
            $partial, [
                "entities" => $entities,
                "type"     => $type
            ]
        );
    }

?>
