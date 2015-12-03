<?php

/**
 * SiteSettingTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SiteSettingTable extends Doctrine_Table
{
    public static function siteSettingExist($site_id = null, $option_key_id = null){

        $s = self::getSiteSettingBySiteAndOptionKey($site_id, $option_key_id);
        if (!is_null($s) && count($s)) {
            return true;
        }
        return false;
    }

    public static function getSiteSettingBySiteAndOptionKey($site_id = null, $option_key_id, $lang = null){

        if (!is_null($site_id) && !is_null($option_key_id)) {
            $q = self::getInstance()->createQuery("ss")
                ->andWhere("ss.site_id = ?", $site_id)
                ->andWhere("ss.option_key_id = ?", $option_key_id);
            $result = $q->execute();
            return $result;
        }
        return null;

    }


    /**
     * Return a setting value by the site id and the setting name
     *
     * @param integer $site_id      The site's id
     * @param string  $setting_name The name of the setting needed
     *
     * @return string
     */
    public static function getSettingValueForSite($site_id = null, $setting_name, $lang = null)
    {

        $query = self::getInstance()->createQuery('ss')
            ->select('ss.s_value')
            ->innerJoin('ss.OptionKey ok');

        if ($site_id) {
            $query->where('site_id = ? AND ok.name = ?', array($site_id, $setting_name));
        } else {
            $query->where('site_id IS NULL AND ok.name = ?', $setting_name);
        }

        if (is_null($lang) === false){
            $query->andWhere('ss.lang = ?', $lang);
            $value = $query->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
            // Fallback to en language
            if (!$value) {
                $query = self::getInstance()->createQuery('ss')
                    ->select('ss.s_value')
                    ->innerJoin('ss.OptionKey ok');
                if($site_id) {
                    $query->where('site_id = ? AND ok.name = ?', array($site_id, $setting_name));
                } else {
                    $query->where('site_id IS NULL AND ok.name = ?', $setting_name);
                }
                $query->andWhere('ss.lang = "en"');
                $value = $query->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
            }
        } else {
            $value = $query->fetchOne(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
        }

        #if($setting_name == "sitemap_enable"){}

        return $value;
    }//end getSettingValueForSite()

    public static function getSiteSettingsBySiteAsArray($site_id, $lang_key = "all"){
        $mySiteSettings = self::getInstance()
            ->createQuery('ss')
            ->leftJoin('ss.OptionKey opk')
            ->where('ss.is_active = ?', true)
            ->andWhere('ss.site_id = ? OR ss.site_id IS NULL', $site_id)
            ->fetchArray();

        $retval = array();

        foreach ($mySiteSettings as $setting){
            if(!$setting["site_id"]){

                $option_key = $setting['OptionKey']['name'];
                $retval[$site_id][$option_key][$lang_key] = $setting['s_value'];
            }
        }
        foreach ($mySiteSettings as $setting){
            if($setting["site_id"]){

                $option_key = $setting['OptionKey']['name'];
                $retval[$site_id][$option_key][$lang_key] = $setting['s_value'];
            }
        }

        return $retval;
    }

    /**
     * Returns an instance of this class.
     *
     * @return SiteSettingTable The table instance
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SiteSetting');
    }
}