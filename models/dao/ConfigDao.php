<?php
namespace MealBooker\models\dao;
    /*-----------------------------------------------------*/
    /*      _____           _               ___   ___      */
    /*     |  __ \         | |             |__ \ / _ \     */
    /*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
    /*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
    /*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
    /*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
    /*                                                     */
    /*                Date: 29/09/2015 10:55               */
    /*                 All right reserved                  */
/*-----------------------------------------------------*/

use MealBooker\model\Config;

class ConfigDao extends GenericDAO
{

    /**
     * @inheritdoc
     * @param $em EntityManager
     */
    public function __construct($em)
    {
        parent::__construct($em);
    }

    /**
     * @inheritdoc
     * @param $id
     * @return Config
     */
    public function getByPrimaryKey($id)
    {
        return parent::findByPrimaryKey(Config::class, $id);
    }

    /**
     * @inheritdoc
     * @param $id
     * @return Config
     */
    public function getByKey($key)
    {
        $query = $this->entityManager->createQuery('
          SELECT e
          FROM ' . Config::class . ' e
          WHERE e.keyCode = :keyCode'
        )->setParameter('keyCode', $key);
        if($query->getResult() != null)
            return $query->getResult()[0];
        return null;
    }

    /**
     * @inheritdoc
     * @param $ent Config
     */
    public function save($ent)
    {
        parent::save($ent);
    }

    /**
     * @inheritdoc
     * @param $ent
     */
    public function delete($ent)
    {
        parent::delete($ent);
    }

    /**
     * Find All
     * @return Config[]
     */
    public function getAll()
    {
        return parent::findAll(Config::class);
    }
}