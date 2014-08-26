<?php 
namespace Arcana\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('color', new ColorType())
            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return 'state';
    }
}