<?
namespace Arcana\BugtrackerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Entity\Role;
use Symfony\Component\Security\Core\SecurityContextInterface;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin2');
        $userAdmin->setPassword('admin');

        $roleAdmin = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:Role')
            ->findOneByName("admin");
        $userAdmin->setRole($roleAdmin);

        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($userAdmin);
        $password = $encoder->encodePassword($user->getPassword(), $userAdmin->getSalt());
        $userAdmin->setPassword($password);

        $manager->persist($userAdmin);
        $manager->flush();
    }
}