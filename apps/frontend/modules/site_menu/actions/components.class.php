<?php
class site_menuComponents extends sfComponents{

    public function executeTop(sfWebRequest $request){

        /**
         * @var Site $site
         */
        $site = Site::getCurrent();

        $menu = $site->getSiteMenuTreeByType("top");

        $route_name = sfContext::getInstance()->getRouting()->getCurrentRouteName();

        $this->route_name = $route_name;
        $this->menu = $menu;

    }

    public function executeFooter(sfWebRequest $request){
        /**
         * @var Site $site
         */
        $site = Site::getCurrent();

        $menu = $site->getSiteMenuTreeByType("footer");
//        Project::prePrint(count($menu),1);
        $route_name = sfContext::getInstance()->getRouting()->getCurrentRouteName();

        $this->route_name = $route_name;
        $this->menu = $menu;
    }

}
?>
