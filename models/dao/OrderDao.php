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

use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManager;
use MealBooker\model\MealOrder;

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
     * @return MealOrder
     */
    public function getByPrimaryKey($id)
    {
        return parent::findByPrimaryKey(MealOrder::class, $id);
    }

    public function getCurrentMealOrder()
    {
        //set min date
        $startDate = new DateTime();
        $startDate->sub(new DateInterval('P1D'));
        $startDate->setTime(14, 0);
        //set min date
        $stopDate = new DateTime();
        $stopDate->setTime(12, 0);
        return $this->getMealOrderBetween($startDate, $stopDate);
    }


    /**
     * return all order between 2 date
     * @param $start DateTime
     * @param $stop DateTime
     * @return MealOrder[]
     */
    public function getMealOrderBetween($start, $stop)
    {
        $query = $this->entityManager->createQuery('
          SELECT e
          FROM ' . MealOrder::class . ' e
          WHERE e.created >= :start
          AND e.created <= :stop'
        );
        $query->setParameter('start', $start);
        $query->setParameter('stop', $stop);
        $result = $query->getResult();
        return $result;
    }

    /**
     * Find All
     * @return MealOrder[]
     */
    public function getAll()
    {
        return parent::findAll(MealOrder::class);
    }
}