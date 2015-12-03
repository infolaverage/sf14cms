<?php

/**
 * SiteMenu form.
 *
 * @package    mysymfonyoft
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id$
 */
class BackendSiteMenuForm extends BaseSiteMenuForm
{
    use TraitBackendGeneralForm;
    public function configure()
    {

        $this->manageTimestampableFields();

        $this->manageParentIdField();

        $this->manageUrlPredefinedField();

        $this->setDefaults(
            array(
                "url" => "/",
                "is_highlighted"    => false,
                "is_target_blank"   => false,
                "is_active"     => true,
            )
        );

        $this->setOption("form-attributes", ["class"=>"form-horizontal"]);
    }

    protected function manageParentIdField(){

        $parent_id_choices = [""=>""];
        $parents = SiteMenuTable::getAllEntitiesAsArray();
        foreach($parents as $parent){
            $has_parent_text = $parent["parent_id"] ? " --- " : "";
            $parent_id_choices[$parent["id"]] =
                $has_parent_text . ($parent["text"] ? $parent["text"] : "#".$parent["id"]);
        }
        $this->widgetSchema["parent_id"] = new sfWidgetFormChoice([
            "choices" => $parent_id_choices,
            "translate_choices" => false
        ]);
        $this->widgetSchema["parent_id"]->getRenderer()->setOption("translate_choices",false);
        $this->validatorSchema["parent_id"] = new sfValidatorChoice(
            [
                "choices" => array_keys($parent_id_choices),
                "required" => false
            ]
        );

    }

    protected function manageUrlPredefinedField(){

        $url_predefined_choices = SeoUrlHelper::getUrlPredefinedChoices();
        #Project::prePrint($url_predefined_choices); exit;

        $this->widgetSchema["url_predefined"] = new sfWidgetFormChoice(
            array("choices" => $url_predefined_choices),
            array('data-combobox-optgroup' => 'on')
        );

        $this->validatorSchema["url_predefined"] = new sfValidatorChoice(
            array("choices" => array_keys($url_predefined_choices), "required" => false)
        );
        $this->validatorSchema["url_predefined"] = new sfValidatorPass();


    }
}
