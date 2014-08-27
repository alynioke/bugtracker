<?php
namespace Arcana\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BugType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('priority', 'integer', array('attr' => array('min' => 0, 'max' => 10)))
            ->add(
                'project',
                'entity',
                array(
                    'class' => 'Arcana\BugtrackerBundle\Entity\Project',
                    'property' => 'title',
                    'query_builder' => function (\Arcana\BugtrackerBundle\Entity\ProjectRepository $repository) {
                            return $repository
                                ->createQueryBuilder('p')
                                ->add('orderBy', 'p.title ASC');
                        }
                )
            )
            ->add(
                'state',
                'entity',
                array(
                    'class' => 'Arcana\BugtrackerBundle\Entity\State',
                    'property' => 'title',
                    'query_builder' => function (\Arcana\BugtrackerBundle\Entity\StateRepository $repository) {
                            return $repository
                                ->createQueryBuilder('s')
                                ->add('orderBy', 's.title ASC');
                        }
                )
            )

            ->add('save', 'submit', array('label' => 'Save'));
    }

    public function getName()
    {
        return 'bug';
    }
}