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

use MealBooker\model\Company;
use MealBooker\model\Course;

class CompanyDao extends GenericDao {

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
     * @return Company
     */
    public function getByPrimaryKey($id) {
        return parent::findByPrimaryKey(Company::class, $id);
    }

    /**
     * Find All
     * @return Company[]
     */
    public function getAll() {
        return parent::findAll(Company::class);
    }

    public function getByValidationCode($validationCode){
        $query = $this->entityManager->createQuery('
          SELECT e
          FROM ' . Company::class . ' e
          WHERE e.validationCode = :validcode'
        )->setParameter('validcode', $validationCode);
        if($query->getResult() != null)
            return $query->getResult()[0];
        return null;
    }
}