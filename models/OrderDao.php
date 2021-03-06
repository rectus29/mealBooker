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
use MealBooker\model\Course;
use MealBooker\model\MealOrder;

class OrderDao extends GenericDao
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

    /**
     * return all mealOrder for current timeFrame
     * @return \MealBooker\model\MealOrder[]
     */
    public function getCurrentMealOrder()
    {
        //set ref date
        $refDate = new DateTime();
        if ($refDate > (new DateTime())->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE)) {
            $refDate->add(new DateInterval('P1D'));
        }
        //set min date
        $startDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
        $startDate->sub(new DateInterval('P1D'));
        $startDate->setTime(STARTBOOKINGHOUR, STARTBOOKINGMINUTE);
        //set min date
        $stopDate = (new DateTime())->setTimeStamp($refDate->getTimestamp());
        $stopDate->setTime(STOPBOOKINGHOUR, STOPBOOKINGMINUTE);
        return $this->getMealOrderBetween($startDate, $stopDate);
    }

    /**
     * return meal order for specific course for current timeFrame
     * @param Course $course Course to find
     * @return \MealBooker\model\MealOrder[]
     */
    public function getCurrentMealOrderForCourse($course)
    {
        $result = [];
        foreach($this->getCurrentMealOrder() as $order)
            foreach($order->getMeals() as $meals)
                if($meals->getCourse() ==$course)
                    array_push($result, $order);
        return $result;
    }


    /**
     * return all order between 2 date
     * @param $start DateTime
     * @param $stop DateTime
     * @return MealOrder[]
     */
    public function getMealOrderBetween($start, $stop)
    {
        $queryString = 'SELECT e
                            FROM ' . MealOrder::class . ' e
                            WHERE e.created >= :start
                            AND e.created <= :stop';
        $query = $this->entityManager->createQuery($queryString);
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