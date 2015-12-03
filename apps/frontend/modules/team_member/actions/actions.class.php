<?php

/**
 * team_member actions.
 *
 * @package    s14cms
 * @subpackage team_member
 * @author     Your name here
 * @version    SVN: $Id$
 */
class team_memberActions extends sfActions
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
        $cms = $site->getCmsObject("team_member_index");
        $standard_url = SeoUrlHelper::content_index("TeamMember");
        $breadcrumbs = array(
            array(
                "link"  => $standard_url,
                "text"  => "A csapat",
                "title" => "A csapat"
            )
        );

        $entities = null;

        $entities = TeamMemberTable::getActiveEntitiesBySite($site->getId());

        $this->entities = $entities;
        $this->cms = $cms;
        $this->breadcrumbs = $breadcrumbs;

    }

    public function executeShow(sfWebRequest $request)
    {

    }
}
