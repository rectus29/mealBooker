<?php
/*-----------------------------------------------------*/
/*      _____           _               ___   ___      */
/*     |  __ \         | |             |__ \ / _ \     */
/*     | |__) |___  ___| |_ _   _ ___     ) | (_) |    */
/*     |  _  // _ \/ __| __| | | / __|   / / \__, |    */
/*     | | \ \  __/ (__| |_| |_| \__ \  / /_   / /     */
/*     |_|  \_\___|\___|\__|\__,_|___/ |____| /_/      */
/*                                                     */
/*                Date: 28/09/2015 17:01                */
/*                 All right reserved                  */
/*-----------------------------------------------------*/
namespace MealBooker;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="user")
 */
class User extends DomainObject
{
    /**
     * @Column(type="string")
     * @var String
     */
    private $firstName;

    /**
     * @Column(type="string")
     * @var String
     */
    private $lastName;

    /**
     * @Column(type="string")
     * @var String
     */
    private $mail;

    /**
     * @Column(type="string")
     * @var String
     */
    private $salt;

    /**
     * @Column(type="string")
     * @var String
     */
    private $password;

    /**
     * @Column(type="string")
     * @var String
     */
    private $phoneNumber;

    /**
     * @ManyToOne(targetEntity="Role")
     * @var Role
     */
    private $role;

    /**
     * @ManyToOne(targetEntity="Company")
     * @var Company
     */
    private $company;

    /**
     * @Column(type="boolean")
     * @var bool
     */
    private $optIn = false;

}