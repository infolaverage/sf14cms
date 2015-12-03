<?php
    class myValidatedReferenceImage extends sfValidatedFile{

        use TraitMyValidatedImageBase;

        static $asset_image_type    = "reference_image";
        static $with_debug          = false;
    }
?>