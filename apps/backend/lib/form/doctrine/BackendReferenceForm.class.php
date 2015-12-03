<?php

/**
 * BackendServiceForm form.
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendReferenceForm extends BaseReferenceForm
{

    use TraitBackendFormImageManager;
    use TraitBackendGeneralForm;

    protected static $image_manager_configs = array(
        array(
            "image_field"           => "filename",
            "asset_image_type"      => "reference_image",
            "image_validated_class" => "myValidatedReferenceImage"
        )
    );

    public function configure()
    {
        //$this->manageRoleField();

        $this->manageImageFields();

        $this->manageContentField();
        $this->manageTimestampableFields();
        $this->manageMetaRobotsField();
        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);

        $this->setDefaults(
            array(
                "is_active" => true
            )
        );

    }



    public function getImageLink($lang){
        $r = $this->getObject()->getImageLink("filename", $lang);
        return $r;
    }




    /*
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
    */
}
