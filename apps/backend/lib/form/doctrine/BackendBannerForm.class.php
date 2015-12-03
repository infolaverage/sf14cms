<?php

/**
 * Banner form.
 *
 * @package    s14cms
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendBannerForm extends BaseBannerForm
{

    use TraitBackendFormImageManager;
    use TraitBackendGeneralForm;

    protected static $image_manager_configs = array(
        array(
            "image_field"           => "filename",
            "asset_image_type"      => "banner_image",
            "image_validated_class" => "myValidatedBannerImage"
        )
    );

    public function configure()
    {
        $this->manageUrlField();
        $this->manageTimestampableFields();
        $this->manageDisplayTypeField();
        $this->manageImageFields();
        $this->manageUrlPredefinedField();
        $this->manageContentField();
        $this->manageHeadIconField();

        $this->setDefaults(
            array(
                "is_target_blank" => false,
                "url" => "/"
            )
        );

        //$this->setOption("form-attributes", ["foo"=>"bar", "baz"=>0]);
        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);

        unset(
            $this["template"],
            $this["custom_code"],
            $this["description"]
        );

    }
    public function manageUrlField(){
        $this->widgetSchema["url"] = new sfWidgetFormInput();
    }
    public function manageHeadIconField(){
        $this->widgetSchema["head_icon"] = new sfWidgetFormInput();
    }

    public function getImageLink($lang){
        $r = $this->getObject()->getImageLink("filename", $lang);
        return $r;
    }

    protected function manageDisplayTypeField(){
        $type_choices = BannerTable::getDisplayTypeChoices();
        $this->widgetSchema["display_type"] = new sfWidgetFormChoice(
            array("choices" => $type_choices, "multiple" => false, "expanded" => false)
        );
        $this->validatorSchema["display_type"] = new sfValidatorChoice(
            array("choices" => array_keys($type_choices), "required" => true)
        );
    }



}
