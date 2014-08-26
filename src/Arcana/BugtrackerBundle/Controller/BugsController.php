<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\Bug;
use Arcana\BugtrackerBundle\Form\Type\BugType;


class BugsController extends Controller
{
    public function listAction()
    {
        $bugs = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:Bug')
        ->findAll();
        $params = array( "items" => $bugs);
        $response = $this->render('ArcanaBugtrackerBundle:Bugs:list.html.twig', $params);
        return $response;
    }

    public function addAction(Request $request)
    {
        $bug = new Bug();
        
        $form = $this->createForm(new BugType(), $bug);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bug);
            $em->flush();
            return $this->redirect($this->generateUrl('bugs_list'));
        }

        $params = array('form' => $form->createView());
        $response = $this->render('ArcanaBugtrackerBundle:Bugs:add.html.twig', $params);
        return $response;
    }
    
    public function editAction($id)
    {
                $bugs = 
        $params = array( "items" => $bugs);
        $response = $this->render('ArcanaBugtrackerBundle:Bugs:list.html.twig', $params);
        return $response;

        $bug = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:Bug')
        ->findOne($id);
        
        $form = $this->createForm(new BugType(), $bug);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bug);
            $em->flush();
            return $this->redirect($this->generateUrl('bugs_list'));
        }

        $params = array('form' => $form->createView());
        $response = $this->render('ArcanaBugtrackerBundle:Bugs:add.html.twig', $params);
        return $response;
    }


}