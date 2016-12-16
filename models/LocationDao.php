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

use MealBooker\model\Location;

class LocationDao extends GenericDao {

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
     * @return Location
     */
    public function getByPrimaryKey($id) {
        return parent::findByPrimaryKey(Location::class, $id);
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
     * @return Location[]
     */
    public function getAll() {
        return parent::findAll(Location::class);
    }

    /**
     * Find All User
     * @return Location[]
     */
    public function getAllEnabled() {
        return parent::findAllEnabled(Location::class);
    }
}