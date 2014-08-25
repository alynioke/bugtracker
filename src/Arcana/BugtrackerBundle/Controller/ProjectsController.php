<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\Project;


class ProjectsController extends Controller
{

    public function listAction()
    {
        $projects = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:Project')
        ->findAll();
        $params = array( "items" => $projects);
		$response = $this->render('ArcanaBugtrackerBundle:Projects:list.html.twig', $params);
		return $response;
    }

    public function addAction(Request $request)
    {
        $project = new Project();

        $form = $this->createFormBuilder($project)
            ->add("title", "text")
            ->add('save', 'submit', array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            return $this->redirect($this->generateUrl('projects_list'));
        }

        $params = array('form' => $form->createView());
		$response = $this->render('ArcanaBugtrackerBundle:Projects:add.html.twig', $params);
		return $response;
    }
    
    public function editAction($id)
    {

    }
}