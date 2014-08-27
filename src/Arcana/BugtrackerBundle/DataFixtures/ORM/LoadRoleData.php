<?php

namespace Arcana\BugtrackerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Arcana\BugtrackerBundle\Entity\Role;
use Arcana\BugtrackerBundle\Entity\User;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadRoleData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $roleAdmin = new Role();
        $roleAdmin->setName('admin');
        $roleAdmin->setRole('ROLE_ADMIN');

        $roleManager = new Role();
        $roleManager->setName('manager');
        $roleManager->setRole('ROLE_MANAGER');

        $roleTester = new Role();
        $roleTester->setName('tester');
        $roleTester->setRole('ROLE_TESTER');


        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');

        $manager->persist($roleAdmin);
        $manager->persist($roleManager);
        $manager->persist($roleTester);

        $userAdmin->setRole($roleAdmin);

        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($userAdmin);
        $password = $encoder->encodePassword($userAdmin->getPassword(), $userAdmin->getSalt());
        $userAdmin->setPassword($password);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}