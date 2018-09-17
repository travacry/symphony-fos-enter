<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var Groups[]
     * @ORM\OneToMany(targetEntity="Groups", mappedBy="user")
     */
    protected $groups;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Groups[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Groups[] $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->addRole(User::ROLE_DEFAULT);
    }


}