<?php

/**
 * ServiceTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ServiceTable extends Doctrine_Table
{

    use TraitBaseTableMethods;
    use TraitBaseTableBySiteMethods;

    /**
     * Returns an instance of this class.
     *
     * @return ServiceTable The table instance
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Service');
    }
}