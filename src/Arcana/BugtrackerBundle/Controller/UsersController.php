<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Form\Type\UserType;
use Symfony\Component\Security\Core\SecurityContextInterface;


class UsersController extends Controller
{

    public function listAction()
    {
        $users = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:User')
        ->findAll();
        $params = array( "items" => $users);
        $response = $this->render('ArcanaBugtrackerBundle:Users:list.html.twig', $params);
        return $response;
    }

    public function addAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new UserType(), $user);

        $form->handleRequest($request);
        if($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('users_list'));
        }

        $params = array('form' => $form->createView());
        $response = $this->render('ArcanaBugtrackerBundle:Users:add.html.twig', $params);
        return $response;
    }

    public function editAction($id)
    {

    }
}