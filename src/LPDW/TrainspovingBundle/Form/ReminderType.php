<?php

namespace LPDW\TrainspovingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReminderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arrivalDate')
            ->add('leeway')
            ->add('rfid', 'entity', array(
                'class'       => 'LPDWTrainspovingBundle:RFID',
                'property'    => 'id',
                'empty_value' => 'none'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LPDW\TrainspovingBundle\Entity\Reminder'
        ));
    }

    public function getName()
    {
        return 'lpdw_trainspovingbundle_remindertype';
    }
}
