<?php
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
namespace MealBooker\models\dao;

use MealBooker\model\Dessert;

class DessertDao extends GenericDao
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
     * @return Dessert
     */
    public function getByPrimaryKey($id)
    {
        return parent::findByPrimaryKey(Dessert::class, $id);
    }

    /**
     * Find All Drink
     * @return Dessert[]
     */
    public function getAll()
    {
        return parent::findAll(Dessert::class);
    }

    /**
     * Find All Drink
     * @return Dessert[]
     */
    public function getAllEnabled()
    {
        return parent::findAllEnabled(Dessert::class);
    }
}