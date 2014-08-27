<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Form\Type\UserType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Arcana\BugtrackerBundle\Controller\BaseController;


class UsersController extends BaseController
{

    public function listAction()
    {
        return $this->baseListAction("User");
    }

    public function addAction($id = false, Request $request, $type)
    {
        if ($type == "add") {
            $user = new User();
        } elseif ($type == "edit") {     
            $user = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:User')
            ->findOneById($id);
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
                try {
                    // item added
                    $em->persist($user);
                    $em->flush();
                    $response = $this->redirect($this->generateUrl('users_list'));
                } catch (\Doctrine\DBAL\DBALException $e) {
                    // item was not added, since duplicated title
                    $form->get('username')->addError(new FormError('There is user with such username already! Choose different one.'));

                    $params = array(
                        'form' => $form->createView(),
                        'type' => $type,
                        'entity' => $entity);
                    $response = $this->render('ArcanaBugtrackerBundle::add.html.twig', $params);
                }
                return $response;
            }

            // response if validation errors
            $params = array(
                'form' => $form->createView(), 
                'type' => $type,
                'entity' => 'User');
            $response = $this->render('ArcanaBugtrackerBundle::add.html.twig', $params);
        } else {
            // response if no such id
            $params = array('message' => "User with such id doesn't exist");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:error.html.twig', $params);
        }
        return $response;
    }
}