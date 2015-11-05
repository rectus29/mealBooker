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

class GenericDao {

    /**
     * @var $entityManager EntityManager
     */
    protected $entityManager;

    /**
     * DAO builder
     * @param $em
     */
    public function __construct($em) {
        $this->entityManager = $em;
    }

    /**
     * find an entity by primarykey
     * @param $entity
     * @param $id
     * @return mixed
     */
    public function findByPrimaryKey($entity, $id) {
        return $this->entityManager->find($entity, $id);
    }

    /**
     * Save an entity
     * @param $entity
     */
    public function save($entity) {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * delete an entity
     * @param $entity
     */
    public function delete($entity) {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    /**
     * return all entity of a class
     * @param $entity
     * @return mixed
     */
    public function findAll($entity) {
        $query = $this->entityManager->createQuery("SELECT e FROM ". $entity . " e");
        return $query->getResult();
    }

    /**
     * return all entity of a class
     * @param $entity
     * @return mixed
     */
    public function findAllEnabled($entity) {
        $query = $this->entityManager->createQuery("SELECT e FROM ". $entity . " e WHERE e:state");
        return $query->getResult();
    }


}