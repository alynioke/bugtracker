<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Entity\Role;


class SecurityController extends Controller
{

    /**
     * @Template()
     */

    public function generateAction($limit)
    {

        // $factory = $this->get('security.encoder_factory');
        // $encoder = $factory->getEncoder($user);
        // $password = $encoder->encodePassword('password', $user->getSalt());
        // $user->setPassword($password);


        // $test = null;
        // if ($encoder->isPasswordValid($user2->getPassword(), 'admi', $user2->getSalt()) ) {
        // 	$test = "true";
        // } else {
        // 	$test = "false";
        // }
        // $roleName = $user->getRoles()->getRole();

    }

    public function loginAction(Request $request)
    {


        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContextInterface::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return $this->render(
            'ArcanaBugtrackerBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );


        return new Response("login");
    }

    private function createUserAction()
    {

        // $role = $this->getDoctrine()
        // ->getRepository('ArcanaBugtrackerBundle:Role')
        // ->findOneByName("manager");

        // \Doctrine\Common\Util\Debug::dump($role);

        //       $user = new User();
        //       $user->setUsername('lila2');
        //       $user->setRole($role);

        // $factory = $this->get('security.encoder_factory');
        // $encoder = $factory->getEncoder($user);
        // $password = $encoder->encodePassword('admin', $user->getSalt());
        // $user->setPassword($password);

              // $em = $this->getDoctrine()->getManager();
              // $em->persist($role);
              // $em->persist($user);
              // $em->flush();


    }


}