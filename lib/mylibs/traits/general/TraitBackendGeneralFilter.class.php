<?php
    /**
     * Class TraitBackendGeneralFilter
     *
     * Manage general fields for filters witch are mainly the same in all cases.
     */
    trait TraitBackendGeneralFilter
    {

        public function manageIdField(){
            $this->setWidget('id', new sfWidgetFormFilterInput(array('with_empty' => false)));
            $this->setValidator('id', new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))));
        }

    }
?>