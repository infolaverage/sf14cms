<?php
/**
 * Class GeneralSeoHelper
 */
class GeneralSeoHelper
{
    protected static $translated_elements   = null;
    protected static $translate_prefix      = "seo";
    protected static $cat_name              = "seo";
    protected static $meta_robot_values     = array(
        //0 => "",
        //1 => "inherit", #unused, further logic needed
        "0" => "noindex, nofollow",
        "1" => "noindex, follow",
        "2" => "index, nofollow",
        "3" => "index, follow"
    );


    public static $types_main = array(
        #"site_index", #currently unused
        "site_show",
        "blog_entry_index",
        "blog_entry_show",
        "gallery_index",
        "gallery_show",
        "faq_index",
        "faq_show",
        "contact_index",
        "cms_show"
    );

    protected static $params_dictionary = array(
        "site_show"                 => array(1 => "site_name"),
        "blog_entry_index"          => array(1 => "site_name"),
        "blog_entry_show"           => array(1 => "site_name", 2 => "entity_title"),
        "gallery_index"             => array(1 => "site_name"),
        "gallery_show"              => array(1 => "site_name", 2 => "entity_title"),
        "faq_index"                 => array(1 => "site_name"),
        "faq_show"                  => array(1 => "site_name", 2 => "entity_title"),
        "contact_index"             => array(1 => "site_name"),
        "cms_show"                  => array(1 => "site_name", 2 => "entity_title"),
    );

    public static $seo_html_elements = array(
        "html_title",
        "meta_title",
        "meta_description",
        "og_title",
        "og_description",
        //"meta_keywords",
        "h1_1",
        "h2_1", "h2_2", "h2_3",
        "h3_1", "h3_2", "h3_3"
    );

    protected static $parameter_holder = array(
        "%1%", "%2%", "%3%", "%4%", "%5%", "%6%", "%7%", "%8%",
    );

    /**
     * Retrieves the possible values of robots meta tag
     *
     * @return array
     */
    public static function getMetaRobotValues(){
        return self::$meta_robot_values;
    }//end getMetaRobotValues()

    /**
     * Retrieves the value of meta robot depending by key
     *
     * @param $key
     *
     * @return mixed
     */
    public static function getMetaRobotValueByKey($key){
        $values = self::getMetaRobotValues();
        $ret_val = null;
        if (isset($values[$key])) {
            $ret_val = $values[$key];
        } else {
            $ret_val = $values[0];
        }

        return $ret_val;
    }//end getMetaRobotValueByKey()

    /**
     * Returns the translation prefix for i18n 'source'
     *
     * @return string
     */
    public static function getTranslatePrefix() {
        return self::$translate_prefix;
    }//end getTranslatePrefix()

    /**
     * Returns the i18n catalogue name for SEO translations
     * @return string
     */
    public static function getCatalogueName()
    {
        return self::$cat_name;
    }//end getCatalogueName()

    /**
     * Returns the params dictionary for helping backend text inputs
     *
     * @return array
     */
    public static function getParamsDictionary()
    {
        return self::$params_dictionary;
    }//end getParamsDictionary()

    /**
     * Returns the available page typies with seo elements, site_show, product_index, etc
     *
     * @return array
     */
    public static function getTypesMain()
    {
        return self::$types_main;
    }//end getTypesMain()

    /**
     * Returns the seoable elements list title, description, h1_1, h2_1, h2_2 etc.
     *
     * @return array
     */
    public static function getSeoableElements()
    {
        return self::$seo_html_elements;
    }//end getSeoableElements()

    /**
     * Returns the concatenated parameter holder string
     *
     * @return string
     */
    public static function getParameterHolderString()
    {
        return Translate::glue(self::$parameter_holder,"_");
    }//end getParameterHolderString()

    /**
     * Returns all variations for seo translation sources
     *
     * @param string $type
     *
     * @return array
     */
    public static function getSourceVariations($type = "basic")
    {
        $sources = array();
        if($type == "basic")
        {
            foreach(self::getTypesMain() as $type_0)
            {
                $temp_types = array();

                $temp_types[] = $type_0;

                if($type_0 == "site_show")
                {
                    //foreach(self::getXYType() as $type_1)
                    //{
                    //    $temp_types[] = Translate::glue(array($type_0, $type_1));
                    //AND Z
                    //foreach(self::getZ() as $type_2)
                    //{
                    //    $temp_types[] = Translate::glue(array($type_0, $type_1, $type_2));
                    //}
                    //}
                }

                foreach($temp_types as $t)
                {
                    foreach(self::getSeoableElements() as $seo_element){
                        $source = Translate::glue(
                            array(
                                self::getTranslatePrefix(),
                                $t,
                                $seo_element,
                                self::getParameterHolderString()
                            )
                        );
                        $sources[] = $source;
                    }
                }
            }
        }

        return $sources;
    }//end getSourceVariations()

    /**
     * Returns the translated i18n targets for type defined in $final_prefix
     *
     * @param   $final_prefix
     * @param   $args
     * @param   $values
     *
     * @return  array
     */
    public static function getTranslated($final_prefix, $args, $values)
    {
        $ph_args    = is_array($args)   ? implode("-", $args)   : $args;
        $ph_values  = is_array($values) ? implode("-", $values) : $values;

        if(is_array($final_prefix))
        {
            $final_prefix = Translate::glue($final_prefix);
        }

        $param_hash = md5($final_prefix) . md5($ph_args) . md5($ph_values);

        if(isset(self::$translated_elements[$param_hash]))
        {
            #return self::$translated_elements[$param_hash];
        }

        $options = array();
        $parameter_string       = GeneralSeoHelper::getParameterHolderString();
        $options['args']        = $args;
        $options["catalogue"]   = GeneralSeoHelper::getCatalogueName();
        $site                   = Site::getCurrent();
        $seoable_elements       = GeneralSeoHelper::getSeoableElements();
        $return_values          = array();

        foreach($seoable_elements as $seo_element)
        {
            if(empty($values[$seo_element]))
            {
                $seoTranslation = null;

                $glued = Translate::glue(array($final_prefix, $seo_element, $parameter_string));

                #Project::prePrint($glued);
                #if(!Project::getGlobalEnvironmentIs('prod')){ print_r($glued); }

                $seoTranslation = Translate::from($glued, $options);
                /*Project::prePrint($glued);
                Project::prePrint($options);
                Project::prePrint($seoTranslation);
                Project::prePrint("");*/
                #if(!Project::getGlobalEnvironmentIs('prod')){ print_r($seoTranslation);print_r("\n"); }

                if (1 && preg_match('/^'.$final_prefix.'/', $seoTranslation) && $site){
                    $seoTranslation = $site->getCurrentSiteSetting('seo_default_'.$seo_element);
                }

                $return_values[$seo_element] = $seoTranslation ? $seoTranslation : "";
            }
            else
            {
                $return_values[$seo_element] = $values[$seo_element];
            }


        }



        if($values && isset($values['meta_keywords']))
        {
            $return_values['meta_keywords'] = $values['meta_keywords'];
        }

        if($values && isset($values['meta_robots']))
        {
            $return_values['meta_robots'] = $values['meta_robots'];
        }

        #self::$translated_elements[$param_hash] = $return_values;

        return $return_values;
    }//end getTranslated()
}