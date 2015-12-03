<?php

/**
 * service actions.
 *
 * @package    s14cms
 * @subpackage service
 * @author     Your name here
 * @version    SVN: $Id$
 */
class serviceActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
}
