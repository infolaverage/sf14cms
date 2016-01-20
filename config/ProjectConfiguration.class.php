<?php

#require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
#sfCoreAutoload::register();
require_once dirname(__FILE__).'/../lib/vendor/autoload.php';

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('csDoctrineActAsSortablePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('mgI18nPlugin');
    $this->enablePlugins('sfCombinePlugin');
  }
}
