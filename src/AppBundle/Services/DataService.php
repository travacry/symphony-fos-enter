<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 16.09.2018
 * Time: 12:04
 */

namespace AppBundle\Services;


use AppBundle\Repository\DataRepository;
use Doctrine\ORM\EntityManagerInterface;


class DataService
{
    /**
     * @var DataRepository
     */
    private $dataRepository;
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->dataRepository = new DataRepository($this->em);
    }

    public function load($userId)
    {
        return $this->dataRepository->load($userId);
    }


}