<?php class bannerComponents extends sfComponents{

    public function executeCompByType(){

        $site = Site::getCurrent();
        $type = $this->type;

        $entities = null;

        if($type){
            $type_key = array_search($type, BannerTable::getDisplayTypeChoices());
            if($type_key){
                $entities = BannerTable::getActiveEntitiesByTypeAndSiteId($type_key, $site->getId());
            }
        }
        #Project::prePrint($type." : ".count($entities));

        $this->entities = $entities;

    }

}

