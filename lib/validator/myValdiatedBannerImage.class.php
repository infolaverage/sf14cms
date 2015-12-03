<?php
    class myValidatedBannerImage extends sfValidatedFile{

        use TraitMyValidatedImageBase;

        static $asset_image_type = "banner_image";
        static $with_debug          = false;
    }
?>