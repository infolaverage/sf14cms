<?php

/**
 * cms actions.
 *
 * @package    s14cms
 * @subpackage cms
 * @author     Your name here
 * @version    SVN: $Id$
 */
class cmsActions extends sfActions
{

    public function preExecute(){
        /**
         * @var Site $site
         */
        $this->site = Site::getCurrent();
    }

    public function executeShow(sfWebRequest $request)
    {
        $site = $this->site;
        $p_id = $request->getParameter("id");
        $this->forward404Unless($p_id);
        /**
         * @var Cms $entity
         */
        $entity = CmsTable::getActiveEntityByIdBySite($site->id, $p_id);
        $this->forward404Unless($entity);

        $object_final_seo_params = $entity->getFinalObjectSeoParams();
        Project::createAndSetMetaData($this->getResponse(), $object_final_seo_params);

        //EXCEPTIONS by ROLE field value ===============================================================================
        if(0 && $entity->getRole() == CmsTable::getRoleOptionKey("contact_thank_you")){
            //echo $site->id; exit;
            if($this->getUser()->getAttribute("contact_sent_success")){
                $this->getUser()->setAttribute("contact_sent_success", false);
            }
            else{
                $this->redirect(SeoUrlHelper::contact());
            }
            $this->getResponse()->addMeta("robots","noindex, nofollow");
        }
        //==============================================================================================================

        $standard_url = SeoUrlHelper::content_show($entity);

        $breadcrumbs = array(
            array(
                "link"  => $standard_url,
                "text"  => $entity->getFinalTitle(),
                "title" =>  $entity->getFinalTitle(),
                #"translate_params" => array(
                #    "%1%" => $entity->getFinalTitle()
                #)
            )
        );

        $this->breadcrumbs      = $breadcrumbs;
        $this->entity           = $entity;
        $this->site             = $site;


    }
}
