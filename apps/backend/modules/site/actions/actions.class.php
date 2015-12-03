<?php

require_once dirname(__FILE__).'/../lib/siteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/siteGeneratorHelper.class.php';

/**
 * site actions.
 *
 * @package    s14cms
 * @subpackage site
 * @author     Your name here
 * @version    SVN: $Id$
 */
class siteActions extends autoSiteActions
{



    public function executeShow(sfWebRequest $request){

        $p_id = $request->getParameter("id");
        $this->forward404Unless($p_id);
        $site = SiteTable::getInstance()->find($p_id);
        /**
         * @var Site $site
         */
        $this->forward404Unless($site);
        //$this->forward404Unless(in_array($site->id, array_keys( $this->available_sites )));

        //$company = $site->getCompany();
        //Project::prePrint($this->configuration,1);
        //Project::prePrint($this->helper,1);
        //Project::prePrint($this);
        $breadcrumbs = array(
            //array(
            //    'text' => $company->getFinalName(),
            //    'link' => $this->generateUrl('company_show', $company)
            //),
            array(
                'text' => Translate::from(array("amg","site","list:title")),
                'link' => $this->generateUrl('site')
            ),
            array(
                'text' => $site->getFinalName(),
                'link' => $this->generateUrl('site_show', $site)
            ),
        );
        $this->breadcrumbs = $breadcrumbs;
        $this->site = $site;

    }//end executeShow()

    public function executeSettings(sfWebRequest $request){

        $p_site_id = $request->getParameter("site_id");
        $this->forward404Unless($p_site_id);
        $site = SiteTable::getInstance()->find($p_site_id);
        $this->forward404Unless($site);

        $form = new BackendCustomSiteSettingsForm(array(), array(
            "required_site_id" => $site->id
        ));

        if($request->isMethod("post")){
            $form->bind($request->getParameter($form->getName()));
            if ($form->isValid()) {
                $this->getUser()->setFlash("success","settings.are.valid",false);
                //try
                try{
                    $form->customSave();
                } catch(Exception $e){
                    Project::prePrint($e);
                    exit;
                }

            } else {
                $this->getUser()->setFlash("error","error.with.settings");
            }
        }

        $breadcrumbs = array(
            array(
                'text' => "Sites",
                'link' => $this->generateUrl('site')
            ),
            /*
            array(
                'text' => $site->getFinalName(),
                'link' => $this->generateUrl('site_show', $site)
            ),
            */
            array(
                'text' => "Site Settings",
                'link' => $this->generateUrl('custom_site_setting', array("site_id"=>$site->id))
            )
        );

        $this->breadcrumbs = $breadcrumbs;

        $this->form = $form;
        $this->site = $site;

    }//end executeSettings()
}
