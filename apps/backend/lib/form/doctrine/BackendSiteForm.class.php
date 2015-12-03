<?php

/**
 * Site form.
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendSiteForm extends BaseSiteForm
{

    use TraitBackendGeneralForm;

    public function configure()
    {
        $this->manageDomainField();
        $this->manageTimestampableFields();
        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);
    }

    protected function manageDomainField(){
        $this->getWidgetSchema()->setHelp("domain","http://domain.com");
    }
}
