<?php

/**
 * maintenance actions.
 *
 * @package    s14cms
 * @subpackage maintenance
 * @author     Your name here
 * @version    SVN: $Id$
 */
class maintenanceActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeError404(sfWebRequest $request)
  {

  }

    /*

    public function executeDemo(sfWebRequest $request){

        Project::prePrint(SeoUrlHelper::default_index("TeamMember"));
        Project::prePrint(SeoUrlHelper::default_index("Reference"));
        Project::prePrint(SeoUrlHelper::contact());
        exit;

    }
    */
}
