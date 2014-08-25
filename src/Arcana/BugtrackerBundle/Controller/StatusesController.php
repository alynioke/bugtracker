<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\Status;
use Arcana\BugtrackerBundle\Form\Type\StatusType;

class StatusesController extends Controller
{
    public function listAction()
    {
        $statuses = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:Status')
        ->findAll();
        $params = array( "items" => $statuses);
        $response = $this->render('ArcanaBugtrackerBundle:Statuses:list.html.twig', $params);
        return $response;
    }

    public function addAction(Request $request)
    {
        $status = new Status();
        
        $form = $this->createForm(new StatusType(), $status);

        $form->handleRequest($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($status);
            $em->flush();
            return $this->redirect($this->generateUrl('statuses_list'));
        }

        $params = array('form' => $form->createView());
        $response = $this->render('ArcanaBugtrackerBundle:Statuses:add.html.twig', $params);
        return $response;
    }
    
    public function editAction($id)
    {

    }
}