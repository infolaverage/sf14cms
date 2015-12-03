<?php

/**
 * Class SeoUrlHelper
 *
 * Generates seo friendly url's for objects and custom routes.
 */
class SeoUrlHelper
{
    private static $site;
    private static $app_name;
    private static $old_configs;

    /**
     *
     * This need to be called in all cases to manage environment and exceptions before generating seo url's.
     *
     * @param Object $site_obj Exact site where need to generate url.
     * @throws Exception
     */
    private static function init($site_obj = null)
    {

        try {
            self::$site = Site::getCurrent();
        } catch (Exception $e) {
            self::$site = null;
        }

        if (self::$site) {
            //DO NOTHING...
        } elseif ($site_obj) {
            if (!self::$site && $site_obj) {
                self::$site = SiteTable::getInstance()->find($site_obj->getId());

                if (!self::$site) {
                    throw new Exception("suh:exception:001");
                }
            } elseif (self::$site->id != $site_obj && $site_obj) {
                self::$site = SiteTable::getInstance()->find($site_obj->getId());
            }
        } else {
            throw new Exception("suh:exception:002");
        }

        self::$app_name = null;
        self::$old_configs = sfConfig::getAll();

        if (!sfContext::hasInstance()) {
            $configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
            sfContext::createInstance($configuration);
        } else if (sfContext::getInstance()->getConfiguration()->getApplication() != 'frontend') {
            self::$app_name = sfContext::getInstance()->getConfiguration()->getApplication();
            sfContext::switchTo('frontend');
        }

        sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    }//end init()

    /**
     *
     * Generate homepage url.
     *
     * @param null $site_id
     * @return array|mixed
     */
    public static function openpage($site_id = null)
    {
        self::init($site_id);
        $route = self::getFastFrontendRoute("@homepage", array());
        self::end();

        return $route;
    }//end openpage()

    /**
     *
     * Generate url for unsubscription.
     *
     * @param null $site_id
     * @param array $params
     * @return array|mixed
     */
//    public static function unsubscription($site_id = null, $params = array())
//    {
//        self::init($site_id);
//        $route = self::getFastFrontendRoute("@newsletter_unsubscribe", $params);
//        self::end();
//
//        return $route;
//    }//end unsubscription()
//
//    /**
//     *
//     * Generate url for validation reset.
//     *
//     * @param null $site_id
//     * @param array $params
//     * @return array|mixed
//     */
//    public static function resetValidate($site_id = null, $params = array())
//    {
//        self::init($site_id);
//        $route = self::getFastFrontendRoute("@validate", $params);
//        self::end();
//
//        return $route;
//    }//end resetValidate()

    /**
     *
     * Generate url for contact page.
     *
     * @param null $site_obj
     * @return array|mixed
     */
    public static function contact($site_obj = null)
    {
        self::init($site_obj);
        $indexslug = null;
        $site_id  = null;
        if ($site_obj) {
            //var_dump($site_obj);
            $site_id = $site_obj->getId();
        } else {
            try {
                $site_id = Site::getCurrent()->getId();
                $site_obj = Site::getCurrent();
            } catch(Exception $e){
                $indexslug = "";
            }
        }
        if ($indexslug === null) {
            $indexslug = $site_obj->getCurrentSiteSetting('index_slug_contact');
            //Project::prePrint($indexslug."yyyy");
        }

        $route = self::getFastFrontendRoute("@contact", array(
            'index_slug' => $indexslug
        ));

        self::end();

        return $route;
    }//end contact()

//    /**
//     *
//     * Generate url for FAQ page.
//     *
//     * @param null $site_obj
//     * @return array|mixed
//     */
//    public static function faq($site_obj = null)
//    {
//        self::init($site_obj);
//        $route = self::getFastFrontendRoute("@faq", array());
//        self::end();
//
//        return $route;
//    }//end faq()
//
//    /**
//     *
//     * Generate url for HOMEPAGE
//     *
//     * @param null $sf_culture
//     * @param null $site_obj
//     *
//     * @return array|mixed
//     */
//    public static function localized_homepage($sf_culture = null, $site_obj = null){
//        self::init($site_obj);
//        $route = self::getFastFrontendRoute("@localized_homepage", array());
//        self::end();
//        return $route;
//    }//end localized_homepage()
//
//    /**
//     *
//     * Generate url for cms show page.
//     *
//     * @param Cms $object Cms to generate url for.
//     * @param null $sf_culture
//     * @param null $site_obj
//     * @return array|mixed
//     */
//    public static function cms_show($object, $sf_culture = null, $site_obj = null)
//    {
//        //var_dump(get_class($object));exit;
//        self::init($site_obj);
//        /**
//         * @var $object Cms
//         */
//        $route = self::getFastFrontendRoute("cms_show", array(
//            'id'                => $object->getId(),
//            'obj_final_slug'    => $object->getFinalObjectSlug()
//        ));
//
//        self::end();
//
//        return $route;
//    }//end cms_show()
//
//    /**
//     *
//     * Generate url for Content show using fallback if specific function for Object type doesn't exist.
//     *
//     * @param Object $object Object to generate routes for (Active Ingredient, Article, Disease, Case Study, Product)
//     * @param null $site_obj
//     * @return mixed
//     */
    public static function content_show($object, $sf_culture = null, $site_obj = null)
    {
        $class_name = get_called_class();
        //var_dump($class_name);exit;
        $function_name = sfInflector::underscore(get_class($object)) . "_show";
        //var_dump($function_name); exit;
        if (!method_exists($class_name, $function_name) || !is_callable(array($class_name, $function_name))) {
            $function_name = "default_show";
        }
        //var_dump($function_name); exit;
        $show_url = call_user_func_array(array($class_name, $function_name), array(
            $object, $site_obj
        ));

        return $show_url;
    }//end content_show()

    /**
     *
     * Generate url for Content index using fallback if specific function for Object type doesn't exist.
     *
     * @param string $object_class Object class to generate routes for.
     * @param null $site_obj
     * @return mixed
     */
    public static function content_index($object_class, $sf_culture = null, $site_obj = null)
    {
        $class_name = get_called_class();
        $function_name = sfInflector::underscore($object_class) . "_index";

        if (!method_exists($class_name, $function_name) || !is_callable(array($class_name, $function_name))) {
            $function_name = "default_index";
        }
        //Project::prePrint($object_class);
        $index_url = call_user_func_array(array($class_name, $function_name), array(
            $object_class, $site_obj
        ));

        return $index_url;
    }//end content_index()

    /**
     *
     * Default seo url generator for Content types show.
     * If Specific function for a type doesn't defined this will be called.
     *
     * @param Object $object The object to generates route for.
     * @param null $site_obj
     * @return array|mixed
     */
    public static function default_show($object, $sf_culture = null, $site_obj = null)
    {
        //var_dump($object);exit;
        $class_name = get_class($object);
        $underscored_name = sfInflector::underscore($class_name);

        if (!$object) {
            Project::throwException("suh:" . $underscored_name . ":ex:00001a");
        }


        $param_array = array(
            "id"             => $object->id,
            "obj_final_slug" => self::getFinalObjectSlug($object, $sf_culture)
        );

        $site_id = null;

        if ($site_obj && $site_obj->id) {
            $site_id = $site_obj->id;
        }
        self::init($site_obj);
        //var_dump('break_after_seo_site_init_default_show');
        $route = self::getFastFrontendRoute($underscored_name . "_show", $param_array);
        self::end();

        return $route;
    }//end default_show()

    /**
     *
     * Default seo url generator for Content types index.
     * If Specific function for a type doesn't defined this will be called.
     *
     * @param string $object_class Object class to generate route for.
     * @param null $site_obj
     * @return array|mixed
     */
    public static function default_index($object_class, $sf_culture = null, $site_obj = null)
    {
        $underscored_name = sfInflector::underscore($object_class);
        $param_array = array();


        $param_array['sf_culture'] = sfContext::getInstance()->getUser()->getCulture();

        if ($sf_culture) {
            $param_array['sf_culture'] = $sf_culture;
        }

        $site_id = null;

        if ($site_obj && $site_obj->id) {
            $site_id = $site_obj->id;
        } else {
            $site = Site::getCurrent();

            if ($site) {
                $site_obj = $site;
            }
        }

        self::init($site_obj);
        $index_slug = self::getFinalIndexSlug($object_class, $param_array["sf_culture"], $site_obj);
        //echo $index_slug;exit;
        if ($index_slug) {
            $param_array = array(
                "index_slug" => $index_slug
            );
        }

        if (!$index_slug) {
            $route = self::getFastFrontendRoute("@" . $underscored_name . "_index", $param_array);
        } else {
            $route = self::getFastFrontendRoute("@" . $underscored_name . "_index_alt", $param_array);
        }

        self::end();

        return $route;
    }//end default_index()

    /**
     *
     * Get final object slug for an object. This is a helper function to generate seo friendly url's for object show.
     *
     * @param Object $object Trying to call getFinalObjectSlug on a given obejct.
     * @return mixed
     */
    protected static function getFinalObjectSlug($object, $sf_culture = null)
    {
        //var_dump($object);exit;
        $method_exist = method_exists(get_class($object), "getFinalObjectSlug");
        $is_callable = is_callable(array(get_class($object), "getFinalObjectSlug"));
        //var_dump($method_exist);exit;
        //var_dump($is_callable);exit;

        if ($method_exist && $is_callable) {
            $url_slug = $object->getFinalObjectSlug($sf_culture);
            //var_dump($url_slug);exit;
        } else {
            $title = null;
            //var_dump($object);exit;
            $title = isset($object->title_general) ? $object->getTitleGeneral() : $object->getFinalByTitle("title_general");

            $url_slug = Project::slugify($title);
        }

        return $url_slug;
    }//end getFinalObjectSlug()

    /**
     *
     * Get final object slug for an object. This is a helper function to generate seo friendly url's for object index.
     *
     * @param string $object_class Trying to call getFinalIndexSlug on a given class.
     * @param null $site_obj
     * @return mixed|string
     */
    protected static function getFinalIndexSlug($object_class, $sf_culture = null, $site_obj = null)
    {
        $method_exist = method_exists($object_class, "getFinalIndexSlug");
        $is_callable = is_callable(array($object_class, "getFinalIndexSlug"));

        if ($method_exist && $is_callable) {
            $url_slug = call_user_func_array(
                array($object_class, "getFinalIndexSlug"),
                array($object_class, $sf_culture, $site_obj)
            );
        } else {
            $title = sfInflector::underscore($object_class);
            $url_slug = $title;
        }

        return $url_slug;
    }//end getFinalIndexSlug()

    /**
     *
     * Core function of the SeoUrlHelper class. From route names and parameters this will constructed the final url.
     *
     * @param string $route_name Route name to generate url for.
     * @param array $parameters Custom parameters.
     * @param bool $absolute If returned url is absolute or not.
     * @param bool $params_only
     * @return array|mixed The seo friendly url
     */
    private static function getFastFrontendRoute($route_name, array $parameters = array(), $absolute = true, $params_only = false)
    {
        $route_name = str_replace("@", "", $route_name);

        if ($params_only) {
            return $parameters;
        }
        /*
        if (!isset($parameters['sf_culture'])) {
            $parameters['sf_culture'] = sfContext::getInstance()->getUser()->getCulture();
        }

        $languages = sfConfig::get("app_cultures_all");

        if (!in_array($parameters['sf_culture'], $languages)) {
            $parameters['sf_culture'] = "en";
        }
        */
        $urlify = "@" . $route_name . "?" . http_build_query($parameters);
        //var_dump($urlify);exit;
        $relative_url = str_replace('backend_dev_stdxb.php', 'frontend_dev_stdxa.php', url_for($urlify));
        $relative_url = str_replace('admin_backend_sb.php', '', $relative_url);

        if (strpos($relative_url, "symfony/") === 0) {
            $relative_url = str_replace("symfony/", "/", $relative_url);
        }

        if (strpos($relative_url, "/frontend_dev_stdxa.php/") === 0) {
            if (sfConfig::get("sf_environment") != "dev") {
                $relative_url = str_replace("/frontend_dev_stdxa.php/", "/", $relative_url);
            }
        }

        if ($absolute) {
            $prod_domain = self::$site->domain;
            $dev_domain = self::$site->domain_dev;
            $curr_domain = Project::getDomainName(true);
            $domain_final = $prod_domain;

            if (($curr_domain != $prod_domain) && ($curr_domain == $dev_domain)) {
                $domain_final = $dev_domain;
            }
            $return_url = $domain_final . $relative_url;
            $return_url = str_replace("//", "/", $return_url);
            $return_url = str_replace("http:/", "http://", $return_url);
        } else {
            $return_url = $relative_url;
        }

        $return_url = str_replace("/home/infol/sites/s14cms/www/symfony/symfony/", "/", $return_url);
        $return_url = str_replace("/home/infol/dev/sites/s14cms/www/symfony/symfony/", "/", $return_url);

        return $return_url;
    }//end getFastFrontendRoute()

    /**
     *
     * Generate seo url's for specific string given in site menu. By parsing the string construct the url.
     *
     * @param string $raw Specific string
     * @param null $site_obj
     * @param bool $returnObject Seo friendly url.
     * @return array|mixed|null|string
     */
    public static function unescapeUrlPredefinedChoice($raw, $site_obj = null, $returnObject = false)
    {
        $parsed = array();
        $a1 = explode("#", $raw);

        foreach ($a1 as $a) {
            if ($a) {
                $t = explode(":", $a);

                if ($t[0]) {
                    $parsed[$t[0]] = isset($t[1]) ? $t[1] : "";
                }
            }
        }
        //var_dump( $parsed["name"]);exit;
        if ($parsed["type"] == "yml") {
            $route_params = array(
                "route_name" => $parsed["name"],
                "parameters" => array()
            );

            if ($parsed['name'] == 'contact') {

                $site = Site::getCurrent();
                if ($site) {
                    //$indexslug = SiteSettingTable::getIndexSlugByModelName(Site::getCurrent()->getId(), 'contact', sfContext::getInstance()->getUser()->getCulture());
                    $indexslug = $site->getCurrentSiteSetting('index_slug_contact');
                } else {
                    $indexslug = "contact";
                }

                //Project::prePrint($route_params,0);
                //Project::prePrint($indexslug,1);

                $route_params['parameters'] = array('index_slug' => $indexslug);
            }

            return $route_params;
        } elseif ($parsed["type"] == "suh") {
            $url = "";

            if ($parsed["name"] == "content_index") {
                //Project::prePrint($parsed["object_class"]);
                $url = SeoUrlHelper::content_index($parsed["object_class"], $site_obj);
            }

            if ($parsed["name"] == "content_show") {
                $object = Doctrine_Core::getTable($parsed["object_class"])->getEntityById($parsed["param_id"]);

                if ($returnObject) {
                    return $object;
                }

                $url = SeoUrlHelper::content_show($object, $site_obj);
            }

            return $url;
        }

        return null;
    }//end unescapeUrlPredefinedChoice()

    /**
     *
     * Generate seo url's for specific string given in site menu. By parsing the string construct the url.
     *
     * @param bool $withBasic
     * @param bool $withIndex
     * @return array
     */
    public static function getUrlPredefinedChoices($withBasic = true, $withIndex = true)
    {
        $url_choices = array(
            "" => "-"//array(""=>"-")
        );

        if ($withBasic) {
            $url_choices["basic"] = array();
        }

        if ($withIndex) {
            $url_choices["content_index"] = array();
        }

        if ($withBasic) {
            $basic_routes = array(
                "homepage",
                "contact",
                //"faq"
            );
            $url_choices["basic"][] = " ";

            foreach ($basic_routes as $basic_route) {
                $url_choices["basic"]["#type:yml#name:" . $basic_route] = $basic_route;
            }
        }

        if ($withIndex) {
            $content_index_object_classes = [
                "Cms",
                "TeamMember",
                "Reference",
            ];

            foreach ($content_index_object_classes as $object_class) {
                $i = "content_index";
                $j = "#type:suh#name:content_index#object_class:" . $object_class;
                $val = $object_class . " index";
                $url_choices[$i][$j] = $val;
            }
        }

        $content_show_object_classes = [
            "Cms",
            "TeamMember",
            "Reference"
        ]; //array("Blog", "Product", "Cms", "Gallery");

        foreach ($content_show_object_classes as $object_class) {
            $results = Doctrine_Core::getTable($object_class)->getAllEntitiesAsArray();
            $underscored_name = sfInflector::underscore($object_class);

            foreach ($results as $result) {
                $i = "content_show_" . $underscored_name;
                $j = "#type:suh#name:content_show#object_class:" . $object_class . "#param_id:" . $result['id'];
                $final_title = " - ";

                if (isset($result['title_general'])) {
                    $final_title = $result['title_general'];
                }

                $val_a = array(
                    $object_class . " show : ",
                    $final_title,
                    " (#" . $result['id'] . ")"
                );

                $val = implode(" ", $val_a);
                $url_choices[$i][$j] = $val;
            }
        }

        return $url_choices;
    }//end getUrlPredefinedChoices()

    /**
     *
     * If a context switch occured in the init function, this will be switch back.
     * Need to call in every functions in the end.
     */
    private static function end()
    {
        if (self::$app_name !== null) {
            sfContext::switchTo(self::$app_name);
            sfConfig::add(self::$old_configs);
            $currentConfiguration = sfContext::getInstance()->getConfiguration();
            $currentConfiguration->initConfiguration();
        }
    }//end end()

    /*
    public static function category($category_obj, $page = 1){
        self::init($category_obj->site_id);

        $route =  self::getFastFrontendRoute( "category_show", array(
            "page"              => $page,
            "id"                => $category_obj->id,
            "obj_final_slug"    => $category_obj->slug,
        ));

        if (strpos($route, "/") === 0 and strpos($route, "http") === FALSE) {
            $route = Site::getCurrent()->getDomain() . $route;
        }

        self::end();
        return $route;
    }//end category
    */


}

?>