<?php
    /**
     * @var SiteMenu $site_menu
     */
    $entity = $site_menu;
    $url = $entity->getUrl();
    $url_predefined = $entity->getUrlPredefined();
    $url_predefined_p = null;
    if($url_predefined){
        $url_predefined_p = SeoUrlHelper::unescapeUrlPredefinedChoice($url_predefined);
        //$url_predefined_u = url_for($url_predefined_p["route_name"]);
    }

?>

<div class="">
    <?php echo $url ? $url : "~";?>
</div>
<div class="url-predefined-row qt" title="<?php echo $url_predefined;?>">
    <?php echo $url_predefined;?>
</div>

<?php //print_r($url_predefined_p);?>