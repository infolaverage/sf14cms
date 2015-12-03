<?php

/**
 * Contact form.
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendContactForm extends BaseContactForm
{
    use TraitBackendGeneralForm;

    public function configure()
    {
        $this->manageTimestampableFields();

        $this->manageIpAddressField();
        $this->manageSentFromField();
        $this->manageClientInfoField();

        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);
    }

    protected function manageIpAddressField(){
        if (!$this->isNew()) {
            $this->widgetSchema['ip_address'] = new sfWidgetFormPlain(array("value" => $this->getObject()->ip_address));
            unset($this->validatorSchema['ip_address']);
        } else {
            //unset($this['ip_address']);
        }
    }

    protected function manageSentFromField(){
        if (!$this->isNew()) {
            $this->widgetSchema['sent_from'] = new sfWidgetFormPlain(array("value" => $this->getObject()->sent_from));
            unset($this->validatorSchema['sent_from']);
        } else {
            //unset($this['ip_address']);
        }
    }

    protected function manageClientInfoField(){
        if (!$this->isNew()) {
            $this->widgetSchema['client_info'] = new sfWidgetFormPlain(array("value" => $this->getObject()->client_info));
            unset($this->validatorSchema['client_info']);
        } else {
            //unset($this['ip_address']);
        }
    }
}
