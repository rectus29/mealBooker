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

use MealBooker\model\Drink;
use MealBooker\model\Meal;

class DrinkDao extends GenericDAO {

    /**
     * @inheritdoc
     * @param $em EntityManager
     */
    public function __construct($em) {
        parent::__construct($em);
    }

    /**
     * @inheritdoc
     * @param $id
     * @return Drink
     */
    public function findByPrimaryKey($id) {
        return parent::findByPrimaryKey(Drink::class, $id);
    }

    /**
     * @inheritdoc
     * @param $entity
     */
    public function save($entity) {
        parent::save($entity);
    }

    /**
     * @inheritdoc
     * @param $entity
     */
    public function delete($entity) {
        parent::delete($entity);
    }

    /**
     * Find All User
     * @return Drink[]
     */
    public function findAll() {
        return parent::findAll(Drink::class);
    }
}