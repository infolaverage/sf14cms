<?php
/** @var sfGuardUser $sf_user */
if($sf_user->isAuthenticated() && $sf_user->getGuardUser() && $sf_user->getGuardUser()->getIsSuperAdmin()) {
    use_javascript("/resources_core/plugins/jquery-ui/jquery-ui.min.js");
}
?>

<?php if(
    (sfConfig::get("sf_environment") != "dev") ||  # if production
    Project::getGlobalEnvironmentIs("prod")        # or domain is production
):?>
    <?php include_combined_stylesheets() ?>
    <?php include_combined_javascripts() ?>
<?php else:?>
    <?php include_stylesheets()?>
    <?php include_javascripts()?>
<?php endif;?>

<?php include_partial("general/other/google_analytics/uacode");?>
<?php #include_partial("general/other/hotjar/tracking_all")?>
