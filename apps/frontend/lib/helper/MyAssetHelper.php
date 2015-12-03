<?php

    /**
     * Print <title> html tag
     */
    function include_custom_title(){
        /**
         * @var Site $site
         */
        $site   = Site::getCurrent();
        $title  = null;
        //Default
        if ($site) {
            $site_params = $site->getFinalObjectMetaParams();
            $title = isset($site_params['html_title']) ? $site_params['html_title'] : "";
        }
        /**
         * @var sfWebResponse $response
         */
        $response = sfContext::getInstance()->getResponse();
        $slots = $response->getSlots();
        $html_title_slot_content = isset($slots["html_title_slot"]) ? $slots["html_title_slot"] : "";
        //TRY TO GET SLOT
        if($html_title_slot_content){
            $title = $html_title_slot_content;
        } else {
            $title_in_response = $response->getTitle(); //metát hív.
            if ($title_in_response) {
                $title = $title_in_response;
            }
        }

        //if($site){
        //$title = $site->getFinalValueWithReplacedSiteVariables($title);
        //}
        echo content_tag('title', $title)."\n";

    }//end include_custom_title()

    /**
     * Print out basic <meta> tags
     */
    function include_custom_metas(){
        $context        = sfContext::getInstance();
        //$i18n = sfConfig::get('sf_i18n') ? $context->getI18N() : null;
        $i18n           = null; //DONT TRANSLATE TWICE!
        $final_metas    = array();
        /**
         * @var Site $site
         */
        $site           = Site::getCurrent();

        //Default
        if($site){
            $site_params = $site->getFinalObjectMetaParams();
            $final_metas["title"]       = isset($site_params["meta_title"])       ? Project::createMetaTitle($site_params["meta_title"], $site) : "";
            $final_metas["description"] = isset($site_params["meta_description"]) ? Project::createMetaDescription($site_params["meta_description"], $site) : "";
            $final_metas["robots"]      = isset($site_params["meta_robots"])      ? $site_params["meta_robots"] : "noindex, nofollow";
        }

        //Set from Response
        foreach ($context->getResponse()->getMetas() as $name => $content) {
            if ($content) {
                $final_metas[$name] = $content;
            }
        }

        /*if($site){
            foreach ($final_metas as $meta_name => $meta_content) {
                $final_metas[$meta_name] = $site->getFinalValueWithReplacedSiteVariables($meta_content);
            }
        }*/


        //Print out
        foreach ($final_metas as $meta_name => $meta_content) {
            //$final_meta_content = (null === $i18n) ? $meta_content : $i18n->__($meta_content);
            $final_meta_content = $meta_content;

            $my_meta_array = array(
                'name'      => $meta_name,
                'content'   => $final_meta_content
            );

            if($meta_name == "title") {
                $my_meta_array = array(
                    'property'  => $meta_name,
                    'content'   => $final_meta_content
                );
            }

            echo tag_html5('meta', $my_meta_array)."\n";
        }
    }//end include_custom_metas()

    /**
    * Print out HTML5 compatible simple tag, for example <meta ...> insted of <meta .../>
    * @param $name
    * @param array $options
    * @param bool $open
    * @return string
    */
    function tag_html5($name, $options = array(), $open = false){
        if (!$name) {
            return '';
        }
        //return '<'.$name._tag_options($options).(($open) ? '>' : '>');
        return '<'.$name._tag_options($options).'>';
    }//end tag_html5()

?>