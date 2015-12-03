<?php
class cmsComponents extends sfComponents{

    /**
     * @param sfWebRequest $request
     * @param [role]
     */
    public function executeCompCms(sfWebRequest $request){

        $role           = $this->role;
        $entity         = null;

        if($role){
            $site           = Site::getCurrent();
            $entity         = $site->getCmsObject($role);
        }

        $this->entity   = $entity;
    }

}
