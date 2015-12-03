<?php if(0/* && Project::getGlobalEnvironmentIs("prod")*/):?>
    <?php //include_combined_stylesheets() ?>
    <?php //include_combined_javascripts() ?>
<?php else:?>

    <?php
    /**
     * @var sfGuardUser $sf_user
    */?>
    <?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->getIsSuperAdmin()):?>
        <?php use_javascript("/resources_core/plugins/jquery-ui/jquery-ui.min.js");?>
    <?php endif;?>
    <?php include_stylesheets()?>
    <?php include_javascripts()?>
<?php endif;?>

<?php include_partial("general/other/google_analytics/uacode")?>
