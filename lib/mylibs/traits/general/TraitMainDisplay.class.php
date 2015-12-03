<?php
trait TraitMainDisplay{

    /**
     * Returns the seo tag array for an object. (Object need to implement the functions used here)
     *
     * @return array
     *  @internal html_title
     *  @internal meta_title
     *  @internal meta_description
     *  @internal meta_keywords
     *  @internal meta_robots
     */
    public function getSeoTagArray() {
        $seoarray = array(
            'html_title'        => $this->getHtmlTitle(),
            'meta_title'        => $this->getMetaTitle(),
            'meta_description'  => $this->getMetaDescription(),
            'meta_keywords'     => $this->getMetaKeywords(),
            'meta_robots'       => $this->getMetaRobots()
        );

        /*if(isset($seoarray["meta_description"]) && !$seoarray["meta_description"]){
            $html         = $this->getContent();
            $start        = strpos($html, '<p class="lead"');
            $end         = strpos($html, '</p>', $start);
            $paragraph     = substr($html, $start, $end-$start+4);
            $final = strip_tags($paragraph);
            #$final = str_replace(array("&nbsp;"), array(" "), $final);
            $final = trim(html_entity_decode($final));
            $seoarray["meta_description"] = $final;
        }*/

        return $seoarray;
    }//end getSeoTagArray()

    /**
     * Returns og tags for the object
     *
     * @param $site Current site object
     * @param $culture User culture
     * @param $image_type Object image type
     * @param $type OG type for the object
     *
     * @return array
     */
    public function getOGTags($site, $culture, $image_type = 'basic') {
        $object_final_seo_params = $this->getFinalObjectSeoParams();

        $image = $this->getPrimaryImageByType($image_type);
        $imageLink = "";
        if ($image) {
            $weblink = $image->getWebLink("l", $culture);
            if ($weblink) {
                $imageLink = $site->getDomain().$weblink;
            }
        } else {
            if (get_called_class() == "Product") {
                $images = $this->getGeneralProduct()->getImagesByType($image_type);
            } else {
                $images = $this->getImagesByType($image_type);
            }
            if ($images) {
                if (isset($images[0])) {
                    $weblink = $images[0]->getWebLink("l", $culture);
                    if ($weblink) {
                        $imageLink = $site->getDomain().$weblink;
                    }
                } else {
                    $imageLink = $site->getDomain().$site->getCurrentSiteSetting('default_og_image');
                }
            }
        }

        $canonical_language = $this->retrieveTranslationExistValidated($culture);
        $canonical = SeoUrlHelper::content_show($this, $canonical_language);

        $site_params = $site->getFinalObjectMetaParams();

        $ogarray = array(
            "og:url"                => $canonical,
            "og:title"              => (!empty($object_final_seo_params["meta_title"]) ? $object_final_seo_params["meta_title"] : $site_params["meta_title"]),
            "og:description"        => (!empty($object_final_seo_params["meta_description"]) ? $object_final_seo_params["meta_description"] : $site_params["meta_description"]),
            "og:image"              => $imageLink,
            "og:locale"             => Project::getCulturesWithTerritory($culture),
            "og:locale:alternate"   => $this->getTranslatedLanguages(array($culture))
        );

        $dateFormatter = new sfDateFormat($culture);

        try {
            $formatted_date = $dateFormatter->format($this->getFinalDate(), 's');
            $keywords = $this->getFinalKeywords(null, true, 4);

            $ogarray["og:type"] = 'article';
            $ogarray["article:published_time"] = $formatted_date;
            $ogarray["article:tag"] = $keywords;

        } catch(Exception $e) {
            $ogarray["og:type"] = 'product';
        }
        return $ogarray;

    }//end getOGTags()

    public function getAlternateLanguagesUrls($exclude_langs = array(), $inserts_with = "language"){

        $languages  = $this->getTranslatedLanguages($exclude_langs, $inserts_with);
        $alternates       = array();
        /*if (is_array($languages) && count($languages)) {
            foreach ($languages as $lang) {
                $alternates[$lang] = SeoUrlHelper::content_show($this, $lang);
            }
        }
        */

        $hreflangs = Project::getLocalesToCulture();
        foreach($hreflangs as $locale => $culture){
            if((is_array($languages) && count($languages) && in_array($culture, $languages)) || $locale == "x-default"){
                $alternates[$locale] = SeoUrlHelper::content_show($this, $culture);
            }
        }
        return $alternates;

    }//end getAlternateLanguagesUrls()

}
?>