<?php

/**
 * ArticleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ArticleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return ArticleTable The table instance
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Article');
    }
}