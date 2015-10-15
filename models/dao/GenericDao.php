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

class GenericDAO {

    protected $entityManager;

    public function __construct($em) {
        $this->entityManager = $em;
    }

    public function findByPrimaryKey($entity, $id) {
        return $this->entityManager->find($entity, $id);
    }

    public function save($entity) {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function delete($entity) {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function findAll($entity) {
        $query = $this->entityManager->createQuery("SELECT e FROM ". $entity . " e");
        return $query->getResult();
    }

}