<?php

/**
 * Class TraitFrontendGeneralForm
 *
 * Initial setup for frontend forms.
 */
trait TraitFrontendGeneralForm
{
    /**
     * Returns the translate prefix for a form. (configured via $translate_prefix)
     *
     * @return array
     */
    public function getTranslatePrefix()
    {
        return property_exists(get_class($this), "translate_prefix") ? self::$translate_prefix : array();
    }

    //end getTranslatePrefix()

    /**
     * Return the field Html classes for a form. (configured via $field_html_classes)
     *
     * @return array
     */
    public function getFieldHtmlClasses()
    {
        return property_exists(get_class($this), "field_html_classes") ? self::$field_html_classes : array();
    }

    //end getFieldHtmlClasses()

    /**
     * Returns the field container html classes. (configured via $field_container_html_classes)
     *
     * @return array
     */
    public function getFieldContainerHtmlClasses()
    {
        return property_exists(get_class($this), "field_container_html_classes") ?
            self::$field_container_html_classes :
            array();
    }

    //end getFieldContainerHtmlClasses()

    /**
     * Returns the field display type classes. (configured via $field_display_classes)
     *
     * @return array
     */
    public function getFieldDisplayTypes()
    {
        return property_exists(get_class($this), "field_display_classes") ? self::$field_display_classes : array();
    }
    //end getFieldDisplayTypes()
}

?>