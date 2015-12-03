<?php

/**
 * Translate
 *
 * This class manages translations and alphabets by cultures.
 * Contains useful function for translation string manipulations.
 */
class Translate
{
    protected static $separator = ":";

    protected static $alphabets = array(
        "cs" => array("A", "Á", "B", "C", "Č", "D", "Ď", "E", "É", "Ě", "F", "G", "H", "Ch", "I", "Í", "J", "K", "L", "M", "N", "Ň", "O", "Ó", "P", "Q", "R", "Ř", "S", "Š", "T", "Ť", "U", "Ú", "Ů", "V", "W", "X", "Y", "Ý", "Z", "Ž"),
        "de" => array("A", "ä", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "Ö", "P", "Q", "R", "S", "T", "U", "Ü", "V", "W", "X", "Y", "Z"),
        "el" => array("α", "β", "Γ", "Δ", "ε", "ζ", "η", "Θ", "ι", "κ", "Λ", "μ", "ν", "Ξ", "ο", "Π", "ρ", "Σ", "τ", "υ", "Φ", "χ", "Ψ", "Ω"),
        "en" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"),
        "es" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"),
        "et" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "Š", "Z", "Ž", "T", "U", "V", "W", "Õ", "Ä", "Ö", "Ü", "X", "Y"),
        "fi" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z", "Å", "Ä", "Ö"),
        "fr" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"),
        "hu" => array("A", "Á", "B", "C", "D", "DZ", "DZS", "E", "É", "F", "G", "GY", "H", "I", "Í", "J", "K", "L", "LY", "M", "N", "O", "Ó", "Ö", "Ő", "P", "Q", "R", "S", "SZ", "T", "TY", "U", "Ú", "Ü", "Ű", "V", "W", "X", "Y", "Z", "ZS"),
        "it" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Z", "Y", "Z"),
        "lt" => array("A", "Ą", "B", "C", "Č", "D", "E", "Ę", "Ė", "F", "G", "H", "I", "Į", "Y", "J", "K", "L", "M", "N", "O", "P", "R", "S", "Š", "T", "U", "Ų", "Ū", "V", "Z", "Ž"),
        "lv" => array("A", "Ā", "B", "C", "Č", "D", "E", "Ē", "F", "G", "Ģ", "H", "I", "Ī", "J", "K", "Ķ", "L", "Ļ", "M", "N", "Ņ", "O", "P", "R", "S", "Š", "T", "U", "Ū", "V", "Z", "Ž"),
        "nl" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "IJ", "Z"),
        "no" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "Æ", "Ø", "Å"),
        "pl" => array("A", "Ą", "B", "C", "Ć", "D", "E", "Ę", "F", "G", "H", "I", "J", "K", "L", "Ł", "M", "N", "Ń", "O", "Ó", "P", "R", "S", "Ś", "T", "U", "W", "Y", "Z", "Ź", "Ż"),
        "pt" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"),
        "ro" => array("A", "Ă", "Â", "B", "C", "D", "E", "F", "G", "H", "I", "Î", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "Ș", "T", "Ț", "U", "V", "W", "X", "Y", "Z"),
        "ru" => array("а", "Б", "в", "Г", "Д", "е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я"),
        "sk" => array("A", "Á", "Ä", "B", "C", "Č", "D", "Ď", "Dz", "Dž", "E", "É", "F", "G", "H", "CH", "I", "Í", "J", "K", "L", "Ĺ", "Ľ", "M", "N", "Ň", "O", "Ó", "Ô", "P", "Q", "R", "Ŕ", "S", "Š", "T", "Ť", "U", "Ú", "V", "W", "X", "Y", "Ý", "Z", "Ž"),
        "sl" => array("A", "B", "C", "Č", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "O", "P", "R", "S", "Š", "T", "U", "V", "Z", "Ž"),
        "sv" => array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "Å", "Ä", "Ö"),
    );

    /**
     * @return string
     */
    public static function getTranslateSeparator()
    {
        return self::$separator;
    }//end getTranslateSeparator()

    /**
     *
     * Orders a list fo content (Active Ingredient, Disease)
     *
     * @param string $culture Culture of user
     * @param null $result Dataset (Active Ingredient, Disease)
     * @param string $field The reference field dataset will ordered by
     * @param bool $put_field_value_only If result array contain only field values or full objects.
     * @return array Alphabetically ordered dataset
     */
    public static function getAlphabeticallyOrdered($culture = "en", $result = null, $field = "title", $put_field_value_only = false)
    {
        $ordered_by_alphabetically = array();
        $alphabet = Translate::getAlphabetByCulture($culture);

        if ($alphabet) {
            foreach ($alphabet as $letter) {
                $ordered_by_alphabetically[strtoupper($letter)] = array();
            }
        }

        if ($result) {
            foreach ($result as $r) {
                $order_base = "";

                if ($field && $r->Translation[$culture] && $r->Translation[$culture]->$field) {
                    $order_base = $r->Translation[$culture]->$field;
                } elseif ($field && $r->Translation["en"] && $r->Translation["en"]->$field) {
                    $order_base = $r->Translation["en"]->$field;
                } elseif ($field && $r->$field && $r->Translation["en"] && !$r->Translation["en"]->$field) {
                    $order_base = $r->$field;
                }

                if ($order_base) {
                    $first_letter = strtoupper(mb_substr($order_base, 0, 1, 'UTF-8'));

                    $to_put = null;

                    if ($put_field_value_only) {
                        $to_put = $order_base;
                    } else {
                        $to_put = $r;
                    }

                    $ordered_by_alphabetically[strtoupper($first_letter)][] = $to_put;
                }
            }
        }

        return $ordered_by_alphabetically;
    }//end getAlphabeticallyOrdered()

    /**
     *
     * Get the alphabets of given culture.
     *
     * @param string $culture Culture
     * @param bool $lowercase Retrive the alphabets in lowercase or not.
     * @return array|null Array of alphabets
     */
    public static function getAlphabetByCulture($culture, $lowercase = false)
    {
        if (isset(self::$alphabets[$culture])) {
            $alphabets_results = array();

            foreach (self::$alphabets[$culture] as $letter) {
                if($lowercase) {
                    $alphabets_results[] = mb_strtolower($letter, 'UTF-8');
                } else {
                    $alphabets_results[] = mb_strtoupper($letter, 'UTF-8');
                }
            }

            return $alphabets_results;
        }

        return null;
    }//end getAlphabetByCulture()

    /**
     *
     * Translate source to expected target from database by user culture (or given exact_culture).
     *
     * @param string $source The string to translate
     * @param array $param_options
     *  Array args Arguments of the source string to replace.
     *  string catalogue Catalogue to search in
     *  exact_catalogue Exact catalogue to search in (special translations eg.: seo)
     *  exact_culture Exact culture to translate to
     * @return mixed|null|string Translated string
     */
    static public function from($source, $param_options = array())
    {


        $default_options                    = array();
        $default_options['args']            = array();
        $default_options['catalogue']       = 'messages';
        $default_options['exact_catalogue'] = null;
        $default_options['exact_culture']   = null;
        $default_options['default']         = null;

        $options = $default_options;

        if (count($param_options)) {
            foreach ($param_options as $key => $value) {
                $options[$key] = $value;
            }
        }
        //echo "..".$options['default'].".."; //exit;

        if (is_array($source)) {
            $source = Translate::glue($source);
        }

        //return $source;

        $rtr = null;
        if (sfContext::hasInstance()) {
            //if (is_array($source)) {
            //    $source = Translate::glue($source);
            //}

            $context            = sfContext::getInstance();
            $configuration      = $context->getConfiguration();
            $configuration->loadHelpers('I18N');

            $translated         = "";
            $temp_translated    = null;

            //FIND EXCEPTION HERE!
            //----------------------------------------------------------------------------------
            $exception_catalogues = array("seo");

            //FIRST APPROXIMATION is BY CATALOGUE
            //----------------------------------------------------------------------------------
            if (in_array($options['catalogue'], $exception_catalogues)) {
                $stut_sources   = array_combine(array($source), array($source));
                #Project::prePrint($stut_sources); exit;
                $stut_sites     = array(Site::getCurrent()->id);
                $t              = SiteTransUnitTable::getTranslated($stut_sources,"frontend.seo",$stut_sites);
                if (count($t) && isset($t[0]['target'])) {
                    $temp_translated = $t[0]['target'];
                }
            }


            if ($temp_translated) {
                if (
                    isset($options['args']) &&
                    is_array($options['args']) &&
                    !empty($options['args'])
                ) {
                    $translated = str_replace(
                        array_keys($options['args']),
                        array_values($options['args']),
                        $temp_translated
                    );
                }
                else{
                    $translated = $temp_translated;
                }

                /*if($source == "seo:article_index:html_title:%1%_%2%_%3%_%4%_%5%_%6%_%7%_%8%"){
                    Project::prePrint(">>");
                    Project::prePrint($t);
                    Project::prePrint($t);
                    Project::prePrint($source);
                    Project::prePrint($temp_translated, 0, "TT: ", " EndTT");
                    Project::prePrint($translated, 0, "Translated: ", " EndTranslated");
                    Project::prePrint(isset($options['args']), 0, "args: ", " args");
                    Project::prePrint(is_array($options['args']), 0, "args: ", " args");
                    Project::prePrint("<<");
                    exit;
                }*/

            } else {
                $old_culture = null;
                $new_culture = null;

                if ($options['exact_culture'] && $options['exact_catalogue']) {
                    $options["catalogue"] = $options['exact_catalogue'] . "." . $options['exact_culture'];
                }

                $translated = __($source, $options['args'], $options['catalogue'], $options['exact_catalogue']);

                /*
                Project::prePrint($source);
                Project::prePrint($options['catalogue']);
                Project::prePrint($translated);
*/
                $use_fallback = false;

                if (sfContext::getInstance()->getUser()->getCulture() != "en") {
                    if ($translated == $source) {
                        $use_fallback = true;
                    } else {
                        $source_with_args = null;

                        if (isset($options['args']) && is_array($options['args']) && !empty($options['args'])) {
                            $source_with_args = str_replace(
                                array_keys($options['args']),
                                array_values($options['args']),
                                $source
                            );
                        }

                        if($source_with_args && $source_with_args == $translated) {
                            $use_fallback = true;
                        }
                    }
                }

                if($use_fallback)
                {
                    $previous_culture = sfContext::getInstance()->getUser()->getCulture();

                    sfContext::getInstance()->getUser()->setCulture("en");

                    $translated = __($source, $options['args'], $options['catalogue'], $options['exact_catalogue']);

                    sfContext::getInstance()->getUser()->setCulture($previous_culture);
                }
            }

            $rtr = $translated;



            /**
             * Example:
             * $i = 0 -> inf
             * Translate::from(
             *      "demo_b:product:in_cart:%1%",
             *      array(
             *          "args" => array("%1%"=>$i),
             *          "format_number_choice" => true,
             *          "format_number_choice_condition" => "%1%"
             *      )
             * );?>
             *
             * TARGET IN DB: [0] no product|[1] 1 product in cart|(1,+Inf] %1%  products in cart
             *
             */
            $FORMAT_N_KEY   = "format_number_choice";
            $FORMAT_NC_KEY  = "format_number_choice_condition";
            if(isset($param_options[$FORMAT_N_KEY]) && ($param_options[$FORMAT_N_KEY] == true)){

                if(strpos($translated,"|") !== false){
                    $format_number_choice_condition = null;
                    if(isset($param_options["args"][$param_options[$FORMAT_NC_KEY]])){
                        $format_number_choice_condition = $param_options["args"][$param_options[$FORMAT_NC_KEY]];
                    }
                    $nfc_tr = format_number_choice($rtr, $param_options["args"], $format_number_choice_condition);
                    $rtr = $nfc_tr;
                }
            }//end of format_number_choice

        }

        if($rtr == $source && isset($options["default"]) && !is_null($options["default"])){

            $default = $options["default"];
            if(is_array($options["default"])){
                $default = self::glue($options["default"]);
            }

            $rtr = $default;
        }

        return $rtr;
    }//end from()

    /**
     *
     * Implode the given array's string elements by given delimiter.
     *
     * @param Array $pieces Custom array with string elements.
     * @param string $delimiter Delimiter to use for implode.
     * @return string Imploded string.
     */
    static public function glue($pieces, $delimiter = ":")
    {
        if (is_array($pieces)) {
            return implode($delimiter, $pieces);
        }

        return $pieces;
    }//end glue()

    /**
     *
     * Return only the last two components of the source string. If contains only one element return that one.
     *
     * @param string $source The source string to cut
     * @param string $delimiter Delimiter used in source string
     * @return string Shortened source string
     */
    static public function drop($source, $delimiter = ":")
    {
        $parts = explode($delimiter, $source);
        $sub_string = (count($parts) > 1) ? $parts[count($parts) - 2] . $delimiter : "";

        $return_data = $sub_string . $parts[count($parts) - 1];

        return $return_data;
    }//end drop()
}

?>