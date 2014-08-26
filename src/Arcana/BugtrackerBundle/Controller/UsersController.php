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

    public function addAction($id = false, Request $request, $type)
    {
        if ($type == "add") {
            $user = new User();
        } elseif ($type == "edit") {     
            $user = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:User')
            ->findOneById($id);
            $oldUser = $user;
            $user->setPassword("");
        }

        if ($user) {
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
        } else {
            $params = array('type' => "User");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:noSuchValue.html.twig', $params);
        }
        return $response;
    }
}