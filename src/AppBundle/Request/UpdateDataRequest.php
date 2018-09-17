<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 15.09.2018
 * Time: 19:49
 */

namespace AppBundle\Request;

use AppBundle\Entity\Groups;
use AppBundle\Entity\User;
use AppBundle\Repository\DataRepository;

class UpdateDataRequest extends DataRepository
{

    public static function fromData(User $user, Groups $groups)
    {
        $dataRequest = new self();

        $dataRequest->username = $user->getUsername();
        $dataRequest->email = $user->getEmail();

        $dataRequest->date = $groups->getDate();
        $dataRequest->groupName = $groups->getName();
        $dataRequest->groupDesc = $groups->getDesc();

        return $dataRequest;
    }
}