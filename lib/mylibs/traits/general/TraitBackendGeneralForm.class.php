<?php
    /**
     * Class TraitBackendGeneralForm
     *
     * Manage general fields for forms witch are mainly the same in all cases.
     */
    trait TraitBackendGeneralForm
    {

        /**
         * Manages timestampable fields. Indentified as created_at and updated_at.
         */
        protected function manageTimestampableFields() {
            if (!$this->isNew()) {
                $this->widgetSchema['created_at'] = new sfWidgetFormPlain(array("value" => $this->getObject()->created_at));
                unset($this->validatorSchema['created_at']);

                $this->widgetSchema['updated_at'] = new sfWidgetFormPlain(array("value" => $this->getObject()->updated_at));
                unset($this->validatorSchema['updated_at']);
            } else {
                unset($this['created_at']);
                unset($this['updated_at']);
            }
        }//end manageTimestampableFields()

        protected function manageMetaRobotsField(){


            $gsh = GeneralSeoHelper::getMetaRobotValues();
            $seo_meta_robot_choices = array(
                "" => ""
            );
            foreach($gsh as $key => $value){
                $seo_meta_robot_choices[$key] = $value;
            }
            $this->widgetSchema["meta_robots"] = new sfWidgetFormChoice(
                array("choices" => $seo_meta_robot_choices)
            );

            $this->validatorSchema["meta_robots"] = new sfValidatorChoice(
                array(
                    "choices" => array_keys($seo_meta_robot_choices),
                    "required" => false
                )
            );

        }

        protected function manageContentField(){
            $this->widgetSchema["content"]->setAttribute("class","j-ckeditor-default");
            $this->widgetSchema["content"]->setAttribute("data-ckeconfig","content_config.js");
        }

        protected function manageDatePublishedField(){

            $this->widgetSchema["date_published"] = new sfWidgetFormInput();
            $this->widgetSchema->setHelp("date_published", "2015-05-26 04:10:01");

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
?>