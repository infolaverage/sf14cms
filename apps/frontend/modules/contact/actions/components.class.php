<?php

/**
 * contact actions.
 *
 * @package    s14cms
 * @subpackage contact
 * @author     Your name here
 * @version    SVN: $Id$
 */
class contactComponents extends sfComponents
{
    /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
    public function executeSimple(sfWebRequest $request)
    {
        /**
         * @var Site $site
         */
        $site           = Site::getCurrent();
        $cms            = null; //$site->getCmsObject('contact');
        //$standard_url   = $this->generateUrl("contact"); #SeoUrlHelper::contact();
        $form           = new FrontendContactForm(
            [],
            ["required_site_id" => $site->getId()]
        );

        $this->form     = $form;
    }
}
