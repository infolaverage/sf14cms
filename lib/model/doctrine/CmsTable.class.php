<?php

/**
 * CmsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CmsTable extends Doctrine_Table
{

    use TraitBaseTableMethods;
    use TraitBaseTableBySiteMethods;

    public static $role_options = array(
        2 => "contact",
        3 => "contact_thank_you",
        //4 => "faq_index_top",
        5 => "contact_simple",

        6 => "team_member_index",

        7 => "openpage_1",

        8 => "footer_1",

        9 => "reference_index",



        #3 => "main_sidebar_content",
        #4 => "main_footer_content"
        # blog_entry_show_sidebar_content...
        # ...
    );

    public static function getRoleOptions(){
        return self::$role_options;
    }

    public static function getRoleOptionValue($key){
        $opt = self::getRoleOptions();
        $res = null;
        if(isset($opt[$key])){
            $res = $opt[$key];
        }

        return $res;
    }

    public static function getRoleOptionKey($value){
        $o = self::getRoleOptions();
        $key = array_search($value, $o);
        if($key !== false){
            return $key;
        }
        return false;
    }


    public static function getActiveEntityBySiteAndRole($site_id, $role_value, Doctrine_Query $q = null){
        if(is_null($site_id)){
            return null;
        }
        $query = self::getActiveEntitiesBySiteQuery($site_id, $q);

        $root_alias = $query->getRootAlias();
        $role_key = self::getRoleOptionKey($role_value);
        if(!$role_key){
            return null;
        }

        $query->andWhere($root_alias.".role = ?", $role_key);
        return $query->fetchOne();

    }

    public static function getActiveEntitiesBySiteWithRoles($site_id = null, Doctrine_Query $q = null){
        if(is_null($site_id)){
            return null;
        }
        $query = self::getActiveEntitiesBySiteQuery($site_id, $q);
        $root_alias = $query->getRootAlias();
        //$role_key = self::getRoleOptionKey($role_value);
        $query->andWhere($root_alias.".role IS NOT NULL");

        return $query->execute();
    }

    public static function getActiveEntitiesForSitemapQuery($site_id = null, Doctrine_Query $q = null){
        $query = self::getActiveEntitiesBySiteQuery($site_id, $q);
        $root_alias = $query->getRootAlias();
        $query->andWhere($root_alias.".role IS NULL");
        return $query;
    }

    public static function getActiveEntitiesForSitemap($site_id = null, Doctrine_Query $q = null){
        return self::getActiveEntitiesForSitemapQuery($site_id,$q)->execute();
    }

    /**
     * Returns an instance of this class.
     *
     * @return CmsTable The table instance
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Cms');
    }
}