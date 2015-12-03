<?php

/**
 * Cms form.
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendCmsForm extends BaseCmsForm
{
    use TraitBackendGeneralForm;

    public function configure()
    {
        $this->manageRoleField();
        $this->manageContentField();
        $this->manageTimestampableFields();
        $this->manageMetaRobotsField();
        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);
    }

    protected function manageRoleField(){

        $role_choices = array(""=>" ");
        $role_choices_db = CmsTable::getRoleOptions();
        foreach($role_choices_db as $key => $value){
            $role_choices[$key] = $value;
        }
        $this->widgetSchema["role"] = new sfWidgetFormChoice(
            array(
                "choices" => $role_choices
            )
        );
        $this->validatorSchema["role"] = new sfValidatorChoice(
            array(
                "choices" => array_keys($role_choices),
                "required" => false
            )
        );
    }
}
