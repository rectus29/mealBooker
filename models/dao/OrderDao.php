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

use Doctrine\ORM\EntityManager;
use MealBooker\model\Config;
use MealBooker\model\Order;

class OrderDao extends GenericDAO
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
     * @return Order
     */
    public function getByPrimaryKey($id)
    {
        return parent::findByPrimaryKey(Order::class, $id);
    }
    /**
     * Find All
     * @return Config[]
     */
    public function getAll()
    {
        return parent::findAll(Order::class);
    }
}