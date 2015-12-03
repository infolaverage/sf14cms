<?php
class referenceComponents extends sfComponents{

    /**
     * @param sfWebRequest $request
     * @param [role]
     */
    public function executeCompList(sfWebRequest $request){

        $site           = Site::getCurrent();

        $entities = ReferenceTable::getActiveEntitiesBySite($site->getId());

        $this->entities = $entities;
    }

}
