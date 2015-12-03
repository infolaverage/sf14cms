<?php

require_once dirname(__FILE__).'/../lib/bannerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bannerGeneratorHelper.class.php';

/**
 * banner actions.
 *
 * @package    s14cms
 * @subpackage banner
 * @author     Your name here
 * @version    SVN: $Id$
 */
class bannerActions extends autoBannerActions
{
    public function executePromote()
    {
        $object = Doctrine::getTable('Banner')->findOneById($this->getRequestParameter('id'));

        $object->promote();
        $this->redirect("@banner");
    }

    public function executeDemote()
    {
        $object = Doctrine::getTable('Banner')->findOneById($this->getRequestParameter('id'));

        $object->demote();
        $this->redirect("@banner");
    }
}
