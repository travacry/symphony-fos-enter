<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 15.09.2018
 * Time: 19:43
 */

namespace AppBundle\Form;


use Doctrine\ORM\Mapping\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DataFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupNames', CollectionType::class, [
                'mapped'=>true,
                'allow_add'=>true,
                'required' => false,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type'   => TextType::class
            ])
            ->add('groupDescs', CollectionType::class, [
                'mapped'=>true,
                'allow_add'=>true,
                'required' => false,
                'allow_delete' => true,
                'delete_empty' => true,
                'entry_type'   => TextType::class,
                'label' => 'HHH'
            ])
            ->add('username', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Run save'))
            ->getForm();
    }
}