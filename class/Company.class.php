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

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="company")
 */
class Company extends DomainObject
{



    /**
     * @Column(type="string")
     * @var String
     */
    private $name;

    /**
     * @OneToMany(targetEntity="User", mappedBy="company")
     * @var User[]
     * @Column(type="string")
     */
    private $Users;

    /**
     * Company constructor.
     */
    public function __construct()
    {
    }

}