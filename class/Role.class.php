<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 28/09/2015 17:01               */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
namespace MealBooker;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="role")
 */
class Role extends DomainObject
{
    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @Column(type="string")
     * @var String
     */
    private $description;

    /**
     * @Column(type="integer")
     * @var Integer
     */
    private $weight = 100;

    /**
     * @Column(type="boolean")
     * @var Boolean
     */
    private $isAdmin = false;

    /**
     * @ManytoMany(targetingEntity="Permission")
     * @var Permission[]
     */
    private $permissions = array();

    /**
     * @OneToMany(targetEntity="User", mappedBy="role")
     * @var User[]
     */
    private $Users = array();




}