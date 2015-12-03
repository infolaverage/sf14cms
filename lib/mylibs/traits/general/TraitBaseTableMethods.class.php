<?php

/**
 * Class TraitBaseTableMethods
 *
 * For often used Doctrine queries.
 */
trait TraitBaseTableMethods
{

    public static function retrieveBackendEntityList(){
        return self::getAllEntitiesQuery();
    }
    /**
     * Retrieves the count of all entities
     *
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Query
     */
    public static function getAllEntitiesQuery(Doctrine_Query $q = null) {
        return self::addAllEntitiesQuery($q);
    }//end countAllEntities()

    /**
     * Retrieves the count of all entities
     *
     * @param Doctrine_Query $q
     *
     * @return integer
     */
    public static function countAllEntities(Doctrine_Query $q = null) {
        return self::addAllEntitiesQuery($q)->count();
    }//end countAllEntities()

    /**
     * Retrieves all entities as collection
     *
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Collection
     */
    public static function getAllEntities(Doctrine_Query $q = null) {
        return self::addAllEntitiesQuery($q)->execute();

    }//end getAllEntities()

    /**
     * Retrieves the first entity as object of all entities
     *
     * @param Doctrine_Query $q
     *
     * @return null|Doctrine_Record
     */
    public static function getAllEntitiesFirst(Doctrine_Query $q = null) {
        return self::addAllEntitiesQuery($q)
            ->limit(1)
            ->execute()
            ->getFirst();
    }//end getAllEntitiesFirst()

    /**
     * Retrieves all entities as array
     *
     * @param Doctrine_Query $q
     *
     * @return array|null
     */
    public static function getAllEntitiesAsArray(Doctrine_Query $q = null) {
        return self::addAllEntitiesQuery($q)->fetchArray();
    }//end getAllEntitiesAsArray()

    /**
     * Retrieves the base query of all entities
     *
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Query|null
     */
    public static function addAllEntitiesQuery(Doctrine_Query $q = null) {
        if (is_null($q))
        {
            $q = self::getInstance()->createQuery("e");
        }

        return $q;
    }//end addAllEntitiesQuery()

    /**
     * Returns the entity with given id
     *
     * @param $id
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Record|null
     */
    public static function getEntityById($id, Doctrine_Query $q = null) {
        $query = self::addAllEntitiesQuery($q);
        $root_alias = $query->getRootAlias();

        $result = $query
            ->andWhere($root_alias.".id = ?", $id)
            ->limit(1)
            ->execute()
            ->getFirst();

        return $result;
    }//end getEntityById()

    /**
     * Retrieves of count of active entities
     *
     * @param Doctrine_Query $q
     *
     * @return mixed
     */
    public static function countActiveEntities(Doctrine_Query $q = null) {
        return self::addActiveEntitiesQuery($q)->count();
    }//end countActiveEntities()

    /**
     * Retrieves active entities as collection
     *
     * @param Doctrine_Query $q
     *
     * @return mixed
     */
    public static function getActiveEntitiesQuery(Doctrine_Query $q = null) {
        return self::addActiveEntitiesQuery($q);
    }//end countActiveEntities()



    /**
     * Retrieves active entities as collection
     *
     * @param Doctrine_Query $q
     *
     * @return mixed
     */
    public static function getActiveEntities(Doctrine_Query $q = null) {
        return self::addActiveEntitiesQuery($q)->execute();
    }//end countActiveEntities()

    /**
     * Retrieves active entities as array
     *
     * @param Doctrine_Query $q
     *
     * @return mixed
     */
    public static function getActiveEntitiesAsArray(Doctrine_Query $q = null) {
        return self::addActiveEntitiesQuery($q)->fetchArray();
    }//end getActiveEntitiesAsArray()

    /**
     * Retrieves the base query of active entities, overridden in concrete table classes.
     *
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Query | null
     */
    public static function addActiveEntitiesQuery(Doctrine_Query $q = null) {
        if (is_null($q))
        {
            $q = self::getInstance()->createQuery("e");
        }

        $root_alias = $q->getRootAlias();
        $q->andWhere($root_alias.".is_active = ?", true);

        return $q;
    }//end addActiveEntitiesQuery()

    /**
     * Returns a Doctrine query with given limit, random sorted
     *
     * @param int $limit
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Collection
     */
    public static function getActiveEntitiesRandom($limit = 3, Doctrine_Query $q = null) {
        return self::addActiveEntitiesQuery($q)
            ->limit($limit)
            ->addOrderBy("RAND()");
    }//end getActiveEntitiesRandom()

    /**
     * Construct a query from different params (see below).
     *
     * @param $params
     *  @internal order_by Fields to order by
     *  @internal order_direction Order direction
     *  @internal limit Limit the query
     *  @internal add_translation Join the translation tables
     *  @internal q Base query
     *  @internal ids Ids included
     *  @internal ids_not Ids excluded
     *  @internal offset Offset of the query
     *
     * @return Doctrine_Query|null
     */
    public static function getActiveEntitiesOrderQuery($params) {
        $final_params = array(
            "order_by"          => "id",
            "order_direction"   => "ASC",
            "limit"             => null,
            "add_translation"   => false,
            "q"                 => null,
            "ids"               => null,
            "ids_not"           => null,
            "offset"            => null,
            "site_id"           => null
        );

        if(!isset($params["order_by"])){
            $params["order_by"] = "id";
            $params["order_direction"] = "ASC";
        }
        if($params["order_by"] == "RAND()"){
            $params["order_direction"] = null;
            $final_params["order_direction"] = null;
        }

        foreach($final_params as $key => $value){
            if(isset($params[$key])){
                $final_params[$key] = $params[$key];
            }
        }


        $query = (isset($final_params["q"]) && !is_null($final_params["q"])) ?
            $final_params["q"] :
            self::addActiveEntitiesQuery();

        $query_params = $query->getParams();
        //Project::prePrint($query_params);
        //Project::prePrint($query->());
        //Project::prePrint($query->getFlattenedParams());
        //Project::prePrint(count($query_params["join"]));

        //if(count($query_params["join"])){
        //    echo "c"; exit;
        //    Project::prePrint($query_params["join"],1);
        //}
        //Project::prePrint();
        //exit;

        $root_alias = $query->getRootAlias();

        if ($final_params["add_translation"]) {
            $query->leftJoin($root_alias.".Translation atr");
        }

        if(!is_null($final_params["offset"])){
            $query->offset($final_params["offset"]);
        }

        if(!is_null($final_params["ids_not"])){
            $query->andWhereNotIn($root_alias.".id", $final_params["ids_not"]);
        }

        if(!is_null($final_params["ids"])){

            $final_params_ids = $final_params["ids"];

            if(array_search(-1, $final_params_ids)){
                $final_params_ids[] = -1;
            }

            $query->andWhereIn($root_alias.".id", $final_params["ids"]);
        }
        if (!is_null($final_params["site_id"])) {
            $query->andWhere($root_alias.".site_id = ?", $final_params["site_id"]);
        }
        if (!is_null($final_params["limit"])) {
            $query->limit($final_params["limit"]);
        }

        if (is_array($final_params["order_by"])) {
            /*
            if (count($final_params["order_by"]) != count($final_params["order_direction"])) {
                $final_params["order_direction"] = 'ASC';
            }

            foreach ($final_params["order_by"] as $key => $o_by) {
                if (!is_array($final_params["order_direction"])) {
                    $sort = $final_params["order_direction"];
                } else {
                    $sort = $final_params["order_direction"][$key];
                }
                if ($key == 0) {
                    $query->orderBy($o_by . ' ' . $sort);
                } else {
                    $query->addOrderBy($o_by . ' ' . $sort);
                }
            }
            */
        } else {
            if ($final_params["order_by"] == "preordered_ids") {
                $query->orderBy(' FIELD(id, ' . implode(',', $final_params["ids"]).')');
            } else {
                $query->orderBy($final_params["order_by"] . ' ' . $final_params["order_direction"]);
            }
        }

        return $query;
    }//end getActiveEntitiesOrderQuery()

    /**
     * Retrieves ordered and limited active entities ids
     *
     * @param $params
     *
     * @return array
     */
    public static function getActiveEntitiesOrderedAndLimitedIds($params){
        $results = self::getActiveEntitiesOrderedAndLimitedAsArray($params);
        $ids = array();

        foreach($results as $r){
            $ids[] = $r["id"];
        }

        return $ids;
    }//end getActiveEntitiesOrderedAndLimitedIds()

    /**
     * Retrieves ordered and limited active entities as array
     *
     * @param $params
     *
     * @return Doctrine_Collection
     */
    public static  function getActiveEntitiesOrderedAndLimitedAsArray($params) {
        $query = self::getActiveEntitiesOrderQuery($params);

        return $query->fetchArray();
    }//end getActiveEntitiesOderedAndLimitedAsArray()

    /**
     * Retrieves ordered and limited active entities
     *
     * @param $params
     *
     * @return mixed
     */
    public static function getActiveEntitiesOrderedAndLimited($params) {

        $query = self::getActiveEntitiesOrderQuery($params);

        return $query->execute();
    }//end getActiveEntitiesOrderNot()

    /**
     * Return an active entity by id.
     *
     * @param $id
     * @param Doctrine_Query $q
     *
     * @return Doctrine_Record
     */
    public static function getActiveEntityById($id, Doctrine_Query $q = null, $with_translation = false) {
        $query = self::addActiveEntitiesQuery($q);
        if ($with_translation) {
            $query = self::addTranslationToQuery($query);
        }
        $root_alias = $query->getRootAlias();

        $result = $query
            ->andWhere($root_alias.".id = ?", $id)
            ->limit(1)
            ->execute()
            ->getFirst()
        ;

        return $result;
    }//end getActiveEntityById()

    /**
     * Get the active entities for a sitemap.
     *
     * @param array $params
     *
     * @return Doctrine_Query|null
     */
    public static function getActiveEntitiesForSitemap($params = array()) {
        $base_query = self::addActiveEntitiesQuery();

        return $base_query;
    }//end




}

?>