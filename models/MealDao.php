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

use MealBooker\model\Meal;

class MealDao extends GenericDao {

    /**
     * @inheritdoc
     * @param $user
     */
    public function __construct($em) {
        parent::__construct($em);
    }

    /**
     * @inheritdoc
     * @param $id
     * @return Meal
     */
    public function getByPrimaryKey($id) {
        return parent::findByPrimaryKey(Meal::class, $id);
    }

    /**
     * @inheritdoc
     * @param $user
     */
    public function save($user) {
        parent::save($user);
    }

    /**
     * @inheritdoc
     * @param $user
     */
    public function delete($user) {
        parent::delete($user);
    }

    /**
     * Find All User
     * @return Meal[]
     */
    public function getAll() {
        return parent::findAll(Meal::class);
    }
}