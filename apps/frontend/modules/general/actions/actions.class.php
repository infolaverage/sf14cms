<?php

/**
 * general actions.
 *
 * @package    s14cms
 * @subpackage general
 * @author     Your name here
 * @version    SVN: $Id$
 */
class generalActions extends sfActions
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
