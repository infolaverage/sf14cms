<?php
/**
 * Class FormHelper
 * This class is used for form rendering (i18n, container classes, etc.)
 */
class FormHelper
{

    /**
     * Call form getFieldDisplayType method if possible
     * Returns null if field display type not defined
     *
     * @param $form
     * @param $key
     *
     * @return string|null
     */
    public static function getFieldDisplayType($form, $key)
    {
        $display_types = array();

        if(method_exists($form, "getFieldDisplayTypes")){
            $display_types = $form->getFieldDisplayTypes();
        }

        return isset($display_types[$key]) ? $display_types[$key] : null;

    }//end getFieldDisplayType()

    /**
     * Returns range basic template
     *
     * @param string $class
     *
     * @return string
     */
    public static function getRangeBasicTemplate($class = 'col-md-5')
    {
        $template = '<div class="row range-fields">'.
            '<div class="'.$class.'">'.
            '%from_value%'.
            '</div>'.
            '<div class="range-minus"><i class="fa fa-minus"></i></div>'.
            '<div class="'.$class.'">'.
            '%to_value%'.
            '</div>'.
            '</div>';
        return $template;
    }//end getRangeBasicTemplate()


    /**
     * Returns all field HTML classes of given form
     *
     * @param $form
     *
     * @return array
     */
    public static function getFieldHtmlClasses($form)
    {
        $html_classes = array();
        if(method_exists($form, "getFieldHtmlClasses"))
        {
            $html_classes = $form->getFieldHtmlClasses();
        }

        return $html_classes;
    }//end getFieldHtmlClasses()

    /**
     * Returns all field CONTAINER HTML classes of given form
     *
     * @param $form
     *
     * @return array
     */
    public static function getFieldContainerHtmlClasses($form)
    {
        $html_classes = array();
        if(method_exists($form, "getFieldContainerHtmlClasses"))
        {
            $html_classes = $form->getFieldContainerHtmlClasses();
        }

        return $html_classes;
    }//end getFieldContainerHtmlClasses()

    /**
     * Returns all field OUTER CONTAINER HTML classes of given form
     *
     * @param $form
     *
     * @return array
     */
    public static function getFieldOuterContainerHtmlClasses($form)
    {
        $html_classes = array();
        if(method_exists($form, "getFieldOuterContainerHtmlClasses"))
        {
            $html_classes = $form->getFieldOuterContainerHtmlClasses();
        }

        return $html_classes;
    }//end getFieldOuterContainerHtmlClasses()

    /**
     * Returns rendered i18n label for form field
     *
     * @param $form
     * @param $key
     *
     * @return array
     */
    public static function getRenderedLabelFor($form, $key)
    {
        $deflabel = $form->getWidget($key)->getOption('label');
        if (!empty($deflabel) || !is_null($deflabel)) {
            return $deflabel;
        }

        $label = array(
            FormHelper::getTranslatePrefix($form),
            "field",
            $key
        );

        return $label;
    }//end getRenderedLabelFor()

    /**
     * Returns rendered i18n help message for form field
     *
     * @param $form
     * @param $key
     *
     * @return array
     */
    public static function getRenderedHelpFor($form, $key)
    {
        $help = array(
            FormHelper::getTranslatePrefix($form),
            "help",
            $key
        );

        $special_help = FormHelper::getFieldSpecialHelps($form);

        if( isset($special_help[$key]) )
        {
            $help[] = $special_help[$key];
        }

        return $help;
    }//end getRenderedHelpFor()

    /**
     * Returns all field Special helps of given form
     *
     * @param $form
     *
     * @return array
     */
    public static function getFieldSpecialHelps($form)
    {
        $special_helps = array();

        if(method_exists($form, "getFieldSpecialHelps")){

            $special_helps = $form->getFieldSpecialHelps();
        }

        return $special_helps;
    }//end getFieldSpecialHelps()


    /**
     * return that the fiels has help
     *
     *@param $form
     *
     *@param $key
     *
     *@return boolean
     */
    public static function hasHelp($form, $key) {

        return $form->getWidgetSchema()->getHelp($key);

    }

    /**
     *
     *
     */
    public static function getArrayWithHelpAndLimit($form, $name) {
        $limit_prefix      = "#L" ;
        $help_array = FormHelper::getRenderedHelpFor($form,$name);
        if( isset( $limit_prefix ) ) {
            foreach ( $help_array as $key => $item )
            {
                if ( strpos( $item, $limit_prefix ) !== FALSE )
                {
                    $limit = str_replace($limit_prefix, "", $item);
                    unset($help_array[$key]);
                    break;
                }
            }
        }

        $return_array = array(
            "translate_array"  => $help_array,
            "limit"            => (isset($limit))? $limit : null
        );
        return $return_array;
    }

    /**
     * Returns rendered i18n error for form field
     *
     * @param $form
     * @param string $key
     * @param $error
     * @return mixed|null|string
     */
    public static function getRenderedErrorFor($form, $key = "global_error", $error)
    {

        if($error instanceof sfValidatorErrorSchema)
        {
            $errors = '';

            $i = 0;

            foreach($error as $e)
            {
                if($i > 0){
                    $errors .= "<br />";
                }

                if ($key != "global_error") {
                    $msg = $e->getValidator()->getMessage($e->getCode());
                }
                else {
                    $msg = $e;
                }
                $untransMessge = $msg;

                //if(count($e->getArguments())){
                $appended_str = Translate::from(
                    array(FormHelper::getTranslatePrefix($form), "error", $key, (string)$untransMessge),
                    array("args"=>$e->getArguments())
                );
                //}
                //else{
                //    Translate::from(array(FormHelper::getTranslatePrefix($form), "error", $key, (string)$e));
                //}
                $errors .= $appended_str;
                $i++;
            }

            return $errors;
        }

        if ($key != "global_error") {
            $msg = $error->getValidator()->getMessage($error->getCode());
        }
        else {
            $msg = $error;
        }

        $untransMessge = $msg;

        return Translate::from(array(FormHelper::getTranslatePrefix($form), "error", $key, (string)$untransMessge), array("args"=>$error->getArguments()));

    }//end getRenderedErrorFor()

    /**
     * Returns defined filedsets of a form
     *
     * @param $form
     *
     * @return array|null
     */
    public static function getFormFieldsets($form)
    {
        $fieldsets_definition = null;
        if(method_exists($form,"getFormfieldsets"))
        {
            $fieldsets_definition = $form->getFormFieldsets();
        }
        return $fieldsets_definition;
    }//end getFormFieldsets()

    /**
     * Returns true if form has "prevent unsave" behaviour
     * @param $form
     * @return bool
     */
    public static function getFormPreventUnsave($form)
    {
        $form_with_save_warning = false;
        if(method_exists($form,"getPreventUnsave"))
        {
            $form_with_save_warning = $form->getPreventUnsave();
        }

        return $form_with_save_warning;
    }//end getFormPreventUnsave()

    /**
     * Returns prevent unsave translate source of form
     * @param $form
     * @return string
     */
    public static function getFormPreventUnsaveMessage($form)
    {
        $message = "form:prevent_unsave:beforeunload:default:text";
        if(method_exists($form,"getPreventUnsaveMessage"))
        {
            $message = $form->getPreventUnsaveMessage();
        }

        return $message;

    }//end getFormPreventUnsaveMessage()

    /**
     * Returns Form translate prefix (underscored class or declared name
     *
     * @param $form
     *
     * @return string
     */
    public static function getTranslatePrefix($form)
    {
        $translate_prefix = null;
        if(method_exists($form, "getTranslatePrefix")){
            $translate_prefix = $form->getTranslatePrefix();
        }
        else{
            $translate_prefix = sfInflector::underscore(get_class($form));
        }
        return $translate_prefix;
    }//end getTranslatePrefix()

    /**
     * Return all field of given form
     * @param $form
     * @return mixed
     */
    public static function getAllFields($form)
    {
        $r = array();
        if(method_exists($form, "getAllFields"))
        {
            $r = $form->getAllFields();
        } else{
            $r = $form->getFormFieldSchema();
        }

        return $r;
    }//end getAllFields()

}
?>