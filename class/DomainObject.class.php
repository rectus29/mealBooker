<?php

class DomainObject
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var Integer
     **/
    private $id;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    protected $created;
    /**
     * @Column(type="string")
     * @var string
     */
    protected $status;



}