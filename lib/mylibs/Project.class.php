<?php
class Project{

    /**
     * Forces a string to be Utf8 encoded.
     *
     * @param string $mixed_string String to force to UTF8.
     *
     * @return string
     */
    public static function forceUtf8($mixed_string)
    {
        return Encoding::toUTF8($mixed_string);
    }//end forceUtf8()

    /**
     * Slugify a given string to be able to use in url's.
     *
     * @param string $text
     *
     * @return string Url friendly string.
     */
    static public function slugify($text){
        $text = self::forceUtf8($text);
        $tr = array(
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
            "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
            "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
            "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k",
            "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
            "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
            "я"=>"ya",
            " "=>"-", "."=>"", ","=>"", "/"=>"-", ":"=>"", ";"=>"", "—"=>"", "–"=>"-"
        );
        $text = strtr($text,$tr);
        $expressions = array(
            '/[αΑ][ιίΙΊ]/u' => 'e',
            '/[οΟΕε][ιίΙΊ]/u' => 'i',
            '/[αΑ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'af$1',
            '/[αΑ][υύΥΎ]/u' => 'av',
            '/[εΕ][υύΥΎ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'ef$1',
            '/[εΕ][υύΥΎ]/u' => 'ev',
            '/[οΟ][υύΥΎ]/u' => 'ou',
            '/(^|\s)[μΜ][πΠ]/u' => '$1b',
            '/[μΜ][πΠ](\s|$)/u' => 'b$1',
            '/[μΜ][πΠ]/u' => 'mp',
            '/[νΝ][τΤ]/u' => 'nt',
            '/[τΤ][σΣ]/u' => 'ts',
            '/[τΤ][ζΖ]/u' => 'tz',
            '/[γΓ][γΓ]/u' => 'ng',
            '/[γΓ][κΚ]/u' => 'gk',
            '/[ηΗ][υΥ]([θΘκΚξΞπΠσςΣτTφΡχΧψΨ]|\s|$)/u' => 'if$1',
            '/[ηΗ][υΥ]/u' => 'iu',
            '/[θΘ]/u' => 'th',
            '/[χΧ]/u' => 'ch',
            '/[ψΨ]/u' => 'ps',
            '/[αάΑΆ]/u' => 'a',
            '/[βΒ]/u' => 'v',
            '/[γΓ]/u' => 'g',
            '/[δΔ]/u' => 'd',
            '/[εέΕΈ]/u' => 'e',
            '/[ζΖ]/u' => 'z',
            '/[ηήΗΉ]/u' => 'i',
            '/[ιίϊΙΊΪ]/u' => 'i',
            '/[κΚ]/u' => 'k',
            '/[λΛ]/u' => 'l',
            '/[μΜ]/u' => 'm',
            '/[νΝ]/u' => 'n',
            '/[ξΞ]/u' => 'x',
            '/[οόΟΌ]/u' => 'o',
            '/[πΠ]/u' => 'p',
            '/[ρΡ]/u' => 'r',
            '/[σςΣ]/u' => 's',
            '/[τΤ]/u' => 't',
            '/[υύϋΥΎΫ]/u' => 'i',
            '/[φΦ]/iu' => 'f',
            '/[ωώ]/iu' => 'o'
        );
        $text = preg_replace( array_keys($expressions), array_values($expressions), $text );
        $text = str_replace(
            array('á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', 'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű'),
            array('a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U'),
            $text
        );
        $text = preg_replace('/\W+/', '-', $text);
        $text = strtolower(trim($text, '-'));

        return $text;
    }//end slugify()

    /**
     * Get the current domain name.
     *
     * @param bool $full With http:// or without it.
     *
     * @return null|string
     */
    public static function getDomainName($full = false) {
        $host = isset($_SERVER['HTTP_HOST']) ? @$_SERVER['HTTP_HOST'] : "";

        $http_protocol = "http://";
        if(isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on")){
            $http_protocol = "https://";
        }
        #Project::prePrint($_SERVER);

        if (!$host) {
            return null;
        }

        if ($full) {
            return $http_protocol . $host;
        }

        return $host;
    }//end getDomainName()

    /**
     * Print values like print_r but with html entities for readability.
     * If you want to exit after print you can do that.
     *
     * @param string $text Printable text.
     * @param bool $with_exit If need to exit after print or not.
     * @param string $prefix Prefix
     * @param string $suffix Suffix
     */
    public static function prePrint($text = "PrePrint", $with_exit = false, $prefix = "", $suffix = "") {
        echo "<pre>";
        echo $prefix;
        if (is_null($text)) {
            echo "<< NULL >>";
        } else {
            print_r($text);
        }
        echo $suffix;
        if ($prefix) {
            echo "<br/>";
        }
        echo "</pre>";
        if ($with_exit) {
            exit;
        }
    }//end prePrint()

    /**
     * Throws a 'decorated' exception
     *
     * @param $message
     * @param array $options
     *
     * @throws sfException
     */
    public static function throwException($message, $options = array()) {
        if (sfContext::hasInstance()) {
            sfContext::getInstance()->set('error_msg', $message);
            sfContext::getInstance()->set('options', $options);
        }

        throw new sfException($message);
    }//end throwException()



    public static function getGlobalEnvironmentIs($name, $sf_environment_prod = true, $domain_is_prod = true) {
        $site = Site::getCurrent();

        if (($name == "prod") && $sf_environment_prod && $domain_is_prod) {
            /**
             * @var Site $site
             */
            $domains_available = $site->getDomainsAvailable();

            if(is_array($domains_available) && isset($domains_available["prod"])){
                $final_domain_is_ok = (in_array(Project::getDomainName(true), $domains_available["prod"]));
                $final_environment_is_ok = (sfConfig::get("sf_environment") == "prod");

                if ($final_domain_is_ok && $final_environment_is_ok) {
                    return true;
                }
            }

            return false;
        }

        return false;
    }//end getGlobalEnvironmentIs()


    /**
     * Return the placeholder image gif with base64 encoding.
     *
     * @return string
     */
    public static function getPlaceholderImgTransparent(){
        return sfConfig::get("app_placeholderimg_base64");
    }//end getPlaceholderImgTransparent()

    /**
     * Create and set the meta datas for the current response by param options.
     *
     * @param sfWebResponse $param_response
     * @param $param_options
     *  string html_title
     *  string meta_title
     *  string meta_keywords
     *  string meta_description
     *  int meta_robots
     * @return mixed
     */
    static public function createAndSetMetaData(sfWebResponse $param_response, $param_options) {
        $html_title     = Project::createHtmlTitle(isset($param_options['html_title']) ? $param_options['html_title'] : "");
        $meta_title     = Project::createMetaTitle(isset($param_options['meta_title']) ? $param_options['meta_title'] : "");
        $keywords       = Project::createMetaKeywords(isset($param_options['meta_keywords']) ? $param_options['meta_keywords'] : "");
        $description    = Project::createMetaDescription(isset($param_options['meta_description']) ? $param_options['meta_description'] : "");
        $robots         = Project::createMetaRobots(isset($param_options['meta_robots']) ? $param_options['meta_robots'] : null);

        if ($robots) {
            $param_response->addMeta('robots', $robots);
        }

        $param_response->setTitle($html_title);
        $param_response->addMeta('title', $meta_title);
        $param_response->addMeta('keywords', $keywords);
        $param_response->addMeta('description', $description);

        return $param_response;
    }//end createAndSetMetaData()


    /**
     * Manipulate Html title and return the corrected string
     *
     * @param string $param_html_title
     *
     * @return string
     */
    static public function createHtmlTitle($param_html_title = "") {
        return $param_html_title;
    }//end createHtmlTitle()

    /**
     * Manipulate Meta title and return the corrected string
     *
     * @param string $param_meta_title
     *
     * @return string
     */
    static public function createMetaTitle($param_meta_title = "") {
        return $param_meta_title;
    }//end createMetaTitle()

    /**
     * Manipulate Meta keywords and return the corrected string
     *
     * @param string $param_meta_keywords
     *
     * @return string
     */
    static public function createMetaKeywords($param_meta_keywords = "") {
        return $param_meta_keywords;
    }//end createMetaKeywords()

    /**
     * Manipulate meta description and return the corrected string
     *
     * @param $param_description
     *
     * @return mixed
     */
    static public function createMetaDescription($param_description) {
        return $param_description;
    }//end createMetaDescription()

    /**
     * Manipulate meta robots and return the corrected data
     *
     * @param null $param_robots_key
     *
     * @return null
     */
    static public function createMetaRobots($param_robots_key = null) {
        $robots_values = GeneralSeoHelper::getMetaRobotValues();

        if (!is_null($param_robots_key)) {
            if (isset($robots_values[$param_robots_key])) {
                return $robots_values[$param_robots_key];
            }
        }

        return null;
    }//end createMetaRobots()


    /**
     * getMetaInformationArray
     *
     * @return array
     */
    static public function getMetaInformationArray()
    {
        return array(
            "html_title",
            "meta_title",
            "meta_keywords",
            "meta_description",
            "meta_robots"
        );
    }//end getMetaInformationArray()


}