<?php
    /**
     * @var Site $site
     */
    $site = Site::getCurrent();
?>
<?php if(
    $site &&
    $site->getCurrentDomainOn("prod") &&
    $site->getFinalSettingGoogleAnalyticsEnabled() &&
    $site->getFinalSettingGoogleAnalyticsUaCode() &&
    Project::getGlobalEnvironmentIs("prod")):?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', '<?php echo $site->getFinalSettingGoogleAnalyticsUaCode()?>', 'auto');
        ga('send', 'pageview');
    </script>
    <script type="text/javascript">
        <?php $analyitcsAttributeName = 'analyticsSent_'.$site->getId() ?>
        <?php if (!$sf_user->hasAttribute($analyitcsAttributeName) || $sf_user->getAttribute($analyitcsAttributeName) !== true): ?>
        ga('send', 'event', 'pagevisit', '<?php echo $site->getDomain() ?>', '<?php echo $site->getId() ?>');
        <?php $sf_user->setAttribute($analyitcsAttributeName, true) ?>
        <?php endif; ?>
    </script>
<?php endif;?>


<?php if(
    $site &&
    !$site->getCurrentDomainOn("prod") &&
    $site->getFinalSettingGoogleAnalyticsEnabled() &&
    $site->getFinalSettingGoogleAnalyticsUaCode()
):?>
    <script type="text/javascript">
        /*<?php echo $site->getFinalSettingGoogleAnalyticsUaCode()?>*/
    </script>
<?php endif;?>

<?php /*
<?php if (has_slot('ga_ecommerce')): ?>
    <?php include_slot('ga_ecommerce') ?>
<?php endif; ?>
<?php if (has_slot('ga_events')): ?>
    <?php include_slot('ga_events') ?>
<?php endif; ?>
*/?>