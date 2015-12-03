<?php

    /**
     * Class TraitBaseTableMethods
     *
     * For often used Doctrine queries.
     */
    trait TraitBaseTableBySiteMethods
    {

        /**
         * Get Active Entries Query
         *
         * @param null $site_id
         * @param Doctrine_Query $q
         * @return null|Doctrine_Query $q
         */
        public static function getActiveEntitiesBySiteQuery($site_id = null, Doctrine_Query $q = null) {
            if (is_null($site_id)) {
                return null;
            }
            $q = self::getActiveEntitiesQuery();
            $root_alias = $q->getRootAlias();
            $q->andWhere($root_alias.".site_id = ?", $site_id);

            return $q;
        }

        /**
         * Get Active Entities as Doctrine Collection by Site Id
         *
         * @param null $site_id
         * @param Doctrine_Query $q
         * @return mixed
         */
        public static function getActiveEntitiesBySite($site_id = null, Doctrine_Query $q = null){
            return self::getActiveEntitiesBySiteQuery($site_id, $q)->execute();
        }

        public static function getActiveEntityByIdBySite($site_id = null, $id = null, Doctrine_Query $q = null){
            $query_of_site = self::getActiveEntitiesBySiteQuery($site_id, $q);
            $result = self::getActiveEntityById($id, $query_of_site);

            return $result;
        }

        /**
         * Get Active Entities Counts by Site Id
         *
         * @param null $site_id
         * @param Doctrine_Query $q
         * @return mixed
         */
        public static function getActiveEntitiesBySiteCount($site_id = null, Doctrine_Query $q = null){
            return self::getActiveEntitiesBySiteQuery($site_id, $q)->count();
        }

        /**
         * Get Active Entities as Array by Site Id
         * @param null $site_id
         * @param Doctrine_Query $q
         * @return mixed
         */
        public static function getActiveEntitiesBySiteAsArray($site_id = null, Doctrine_Query $q = null){
            return self::getActiveEntitiesBySiteQuery($site_id, $q)->fetchArray();
        }

        /**
         * Query for Get all Objects for site by site_id
         *
         * @param null $site_id
         * @param Doctrine_Query $q
         * @return Doctrine_Query|null
         */
        public static function getAllEntitiesBySiteQuery($site_id = null, Doctrine_Query $q = null) {
            if (is_null($site_id)) {
                return null;
            }
            $q = self::getAllEntitiesQuery();
            $root_alias = $q->getRootAlias();
            $q->andWhere($root_alias.".site_id = ?", $site_id);

            return $q;
        }//end getAllEntitiesBySiteQuery()

        public static function getAllEntitiesBySite($site_id = null, Doctrine_Query $q = null){
            return self::getAllEntitiesBySiteQuery($site_id, $q)->execute();
        }//end getAllEntitiesBySite()

        public static function getAllEntitiesBySiteCount($site_id = null, Doctrine_Query $q = null){
            return self::getAllEntitiesBySiteQuery($site_id, $q)->count();
        }//end getAllEntitiesBySiteCount()

        public static function getAllEntitiesBySiteAsArray($site_id = null, Doctrine_Query $q = null){
            return self::getAllEntitiesBySiteQuery($site_id, $q)->fetchArray();
        }//end getAllEntitiesBySiteAsArray()

    }

?>