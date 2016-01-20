<?php

class AssetImageHelper{

    public static $image_dir_path = array(
        "gallery_image_original"            => "/images/gi_original_8/",
        "gallery_image"                     => "/images/gi/",
        "banner_image"                      => "/images/ba/",
        "reference_image"                   => "/images/re/",
        "team_member_image"                 => "/images/te/",
        "quote_image"                       => "/images/qu/",
        "product_image_original"            => "/images/pi_original_2/",
        "product_image"                     => "/images/pi/",
        "event_category_image"              => "/images/ei/"
        //"asset_blog_entry_image_original"   => "/images/blog_entry_original_7/",
        //"asset_blog_entry_image"            => "/images/blog_entry/",
    );

    public static $image_dir_depths = array(
        "gallery_image_original"       => 4,
        "gallery_image"                => 4,
        "banner_image"                 => 4,
        "reference_image"              => 4,
        "team_member_image"            => 4,
        "quote_image"                  => 4,
        "product_image_original"       => 4,
        "product_image"                => 4,
        "event_category_image"         => 4,
        //"asset_blog_entry_image_original"   => 4,
        //"asset_blog_entry_image"            => 4,
    );

    /**
     * Returns true if all dependencies (path, path depth) are valid. Otherwise throws an exception
     *
     * @throws sfException
     * @param $type
     *
     * @return bool
     */
    public static function isTypeExist($type)
    {
        if(!$type)
        {
            Project::throwException("asset_image_helper:exception:no_type");
        }

        if(!isset(self::$image_dir_path[$type]))
        {
            #echo $type; exit;
            Project::throwException("asset_image_helper:exception:wrong_type");
        }

        return true;
    }//end isTypeExist()

    /**
     * Returns the asset image path/url
     *
     * @param $type
     * @param bool $is_path
     * @param null $variables
     *
     * @return null|string
     */
    public static function getAssetImagePath($type, $is_path = false, $variables = null)
    {
        if(!self::isTypeExist($type)) return null;

        $root       = sfConfig::get("sf_root_dir");
        $web        = DIRECTORY_SEPARATOR . "web";
        $pre_path   = $is_path ? $root.$web : "";

        $post_path = self::$image_dir_path[$type];

        if(preg_match('^\{.*\}^', $post_path, $matches))
        {
            if($variables && is_array($variables))
            {
                foreach($matches as $match)
                {
                    $cleaned_match = str_replace(array('{', '}'), "", $match);

                    if(isset($variables[$cleaned_match]))
                    {
                        $post_path = str_replace($match, $variables[$cleaned_match], $post_path);
                    }
                }
            }

            if(strstr($post_path, '{') !== false || strstr($post_path, '}') !== false)
            {
                Project::throwException("asset_image_helper:exception:required_path_variable_not_given");
            }
        }

        return $pre_path.$post_path;
    }//end getAssetImagePath()

    /**
     * Returns given type asset directory depth
     *
     * @param $type
     *
     * @return null|integer
     */
    public static function getDirDepth($type)
    {
        if(!self::isTypeExist($type))
        {
            return null;
        }

        return self::$image_dir_depths[$type];
    }//end getDirDepth()

    /**
     * Returns 'middle dir' based on filename hash and declared directory depth
     * For example f/o/o
     *
     * @param $type
     * @param $filename
     *
     * @return string
     */
    public static function getNHash($type, $filename)
    {
        if(!$filename)
        {
            return "";
        }

        $depth = self::getDirDepth($type);
        $depth_path = "";

        for($i = 0; $i < $depth; $i++)
        {
            $depth_path .= $filename[$i];
            if($i < $depth - 1)
            {
                $depth_path .= DIRECTORY_SEPARATOR;
            }
        }

        return $depth_path;
    }//end getNHash()

    /**
     * * Returns 'middle dir' based on filename hash and declared directory depth
     * For example f/o/o/
     *
     * @param $type
     * @param $filename
     *
     * @return string
     */
    public static function getMiddleDir($type, $filename)
    {
        $middle_dir = self::getNHash($type, $filename);
        if($middle_dir)
        {
            $middle_dir .= DIRECTORY_SEPARATOR;
        }

        return $middle_dir;
    }//end getMiddleDir()

    /**
     * Returns full path of asset image
     * Alternative method
     *
     * @param $type
     * @param $filename
     * @param null $options
     *
     * @return string
     */
    public static function getFullPath($type, $filename, $options = null) {
        return self::getAssetImagePath($type, true, $options).self::getMiddleDir($type, $filename).$filename;
    }//end getFullPath()

    /**
     * Returns full URL of asset image
     * Alternative method
     *
     * @param $type
     * @param $filename
     * @param null $options
     *
     * @return string
     */
    public static function getFullUrl($type, $filename, $options = null) {
        return self::getAssetImagePath($type, false, $options).self::getMiddleDir($type, $filename).$filename;
    }//end getFullUrl()
} ?>