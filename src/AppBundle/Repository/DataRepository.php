<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 15.09.2018
 * Time: 22:55
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Groups;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DataRepository
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    public $date;

    /**
     * @var string []
     */
    public $groupNames;

    /**
     * @var string []
     */
    public $groupDescs;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repUser;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repGroups;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repUser = $entityManager->getRepository(User::class);
        $this->repGroups = $entityManager->getRepository(Groups::class);
    }

    /**
     * @param $userId
     * @return $this
     */
    public function load($userId)
    {
        $user = $this->repUser->find($userId);
        $groups = $user->getGroups();

        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
        $this->date = (new \DateTime())->format('Y-m-d');

        foreach ($groups as $group) {
            $this->groupNames[] = $group->getName();
            $this->groupDescs[] = $group->getDesc();
        }

        return $this;
    }

    public function save() {

    }


}