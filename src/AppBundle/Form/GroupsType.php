<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 16.09.2018
 * Time: 11:01
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('groupNames', TextType::class)
            ->add('groupDescs', TextType::class)
            ->getForm();
    }
}