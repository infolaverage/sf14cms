<?php

/**
 * custom_content actions.
 *
 * @package    s14cms
 * @subpackage custom_content
 * @author     Your name here
 * @version    SVN: $Id$
 */
class custom_contentActions extends sfActions
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
