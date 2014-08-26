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

    public function addAction($id = false, Request $request, $type)
    {
        if ($type == "add") {
            $status = new Status();
        } elseif ($type == "edit") {     
            $status = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:Status')
            ->findOneById($id);
        }

        if ($status) {
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
        } else {
            $params = array('type' => "Status");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:noSuchValue.html.twig', $params);
        }
        return $response;
    }
}