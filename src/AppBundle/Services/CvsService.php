<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 19.09.2018
 * Time: 0:48
 */

namespace AppBundle\Services;


use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CvsService
{
    public function run() {

        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $data = $serializer->decode(file_get_contents('data.csv'), 'csv');
    }
}