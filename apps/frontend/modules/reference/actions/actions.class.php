<?php

/**
 * reference actions.
 *
 * @package    s14cms
 * @subpackage reference
 * @author     Your name here
 * @version    SVN: $Id$
 */
class referenceActions extends sfActions
{
    public function preExecute(){
        /**
         * @var Site $site
         */
        $this->site = Site::getCurrent();
    }

    public function executeIndex(sfWebRequest $request)
    {
        /**
         * @var Site $site
         */
        $site = $this->site;
        $this->forward404Unless($site);
        $this->forward404Unless($site->id);
        $cms = $site->getCmsObject("reference_index");
        $standard_url = SeoUrlHelper::content_index("Reference");
        $breadcrumbs = array(
            array(
                "link"  => $standard_url,
                "text"  => "Referenciák",
                "title" => "Referenciák"
            )
        );

        $entities = null;
        $entities = ReferenceTable::getActiveEntitiesBySite($site->getId());

        $this->entities = $entities;
        $this->cms = $cms;
        $this->breadcrumbs = $breadcrumbs;

    }
}
