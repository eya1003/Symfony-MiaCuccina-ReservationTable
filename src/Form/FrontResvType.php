<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Table;
//use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use function Couchbase\defaultEncoder;

class FrontResvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_resv', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('end_resv', DateTimeType::class, [
                'date_widget' => 'single_text'
            ])
            ->add('phone_resv')
            ->add('Email_resv')
            ->add('tab_resv',EntityType::class,['class' => Table::class,
                'label'=>'tab_resv',
                'choice_label'=>"emp"])

            //->add('stock_resv')
            ->add('Enregistrer',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
