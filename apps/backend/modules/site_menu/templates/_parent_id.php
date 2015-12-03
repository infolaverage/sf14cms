<?php
    /**
     * @var SiteMenu $entity
     */
    $entity = $site_menu;
    if($entity && $entity->getParentMenu()){
        echo $entity->getParentMenu()->getText();
    }
?>