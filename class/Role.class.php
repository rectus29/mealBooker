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
    private $isAdmin;


}