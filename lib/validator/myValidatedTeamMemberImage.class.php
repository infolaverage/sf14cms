<?php
    class myValidatedTeamMemberImage extends sfValidatedFile{

        use TraitMyValidatedImageBase;

        static $asset_image_type    = "team_member_image";
        static $with_debug          = false;
    }
?>