<?php
namespace Arcana\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add(
                'password',
                'repeated',
                array(
                    'type' => 'password',
                    'invalid_message' => 'Passwords do not match',
                    'first_name' => 'password:_minimum_6_characters',
                    'second_name' => 'repeat_password',
                    'required' => $options['required']
                )
            )
            ->add(
                'role',
                'entity',
                array(
                    'class' => 'Arcana\BugtrackerBundle\Entity\Role',
                    'property' => 'name',
                    'query_builder' => function (\Arcana\BugtrackerBundle\Entity\RoleRepository $repository) {
                            return $repository
                                ->createQueryBuilder('r')
                                ->add('orderBy', 'r.name ASC');
                        }
                )
            )
            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return 'user';
    }
}