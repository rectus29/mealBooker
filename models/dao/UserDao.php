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

use MealBooker\model\User;

class UserDao extends GenericDAO {

    /**
     * @inheritdoc
     * @param $user
     */
    public function __construct($em) {
        parent::__construct($em);
    }

    /**
     * @inheritdoc
     * @param $user
     */
    public function findByPrimaryKey($id) {
        return parent::findByPrimaryKey(User::class, $id);
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
     * @return User[]
     */
    public function findAll() {
        return parent::findAll(User::class);
    }

    /**
     * find user by Mail address
     * @param $mail
     * @return User|null
     */
    public function getUserByMail($mail)
    {
        $query = $this->entityManager->createQuery("SELECT e FROM User WHERE mail = '". $mail ."'");
        $result =$query->getResult();
        if(sizeof($result)>0)
            return $result[1];
        return null;
    }



}