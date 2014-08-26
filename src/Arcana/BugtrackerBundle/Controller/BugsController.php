<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\Bug;
use Arcana\BugtrackerBundle\Controller\BaseController;
use Arcana\BugtrackerBundle\Form\Type\BugType;


class BugsController extends BaseController
{
    public function listAction()
    {
        return $this->baseListAction("Bug");
    }
    
    public function addAction($id = false, Request $request, $type)
    {
        if ($type == "add") {
            $bug = new Bug();
        } elseif ($type == "edit") {     
            $bug = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:Bug')
            ->findOneById($id);
        }
        
        if ($bug) {
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
        } else {
            $params = array('type' => "Bug");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:noSuchValue.html.twig', $params);
        }
        return $response;
    }


}