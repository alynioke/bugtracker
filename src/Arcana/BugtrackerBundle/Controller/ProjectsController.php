<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Entity\Project;


class ProjectsController extends Controller
{

    public function listAction()
    {
        $arr = array( "items" => array(
        	0 => array("id"=>1, "title" => "test1", "project" => "pr1", "status" => "opened", "priority" => 4),
        	1 => array("id"=>2, "title" => "test2", "project" => "pr2", "status" => "opened", "priority" => 8),
        	2 => array("id"=>3, "title" => "test3", "project" => "pr3", "status" => "closed", "priority" => 2))
        	);
		$response = $this->render('ArcanaBugtrackerBundle:Projects:list.html.twig', $arr);
		return $response;
    }

    public function addAction(Request $request)
    {
        $project = new Project();
        $project->setTitle("test title");

        $form = $this->createFormBuilder($project)
            ->add("title", "text")
            ->add('save', 'submit', array('label' => 'Save'))
            ->getForm();

        $params = array('form' => $form->createView());
		$response = $this->render('ArcanaBugtrackerBundle:Projects:add.html.twig', $params);
		return $response;
    }

    public function editAction()
    {
        $arr = array( "items" => array(
        	0 => array("id"=>1, "title" => "test1", "project" => "pr1", "status" => "opened", "priority" => 4),
        	1 => array("id"=>2, "title" => "test2", "project" => "pr2", "status" => "opened", "priority" => 8),
        	2 => array("id"=>3, "title" => "test3", "project" => "pr3", "status" => "closed", "priority" => 2))
        	);
		$response = $this->render('ArcanaBugtrackerBundle:Projects:list.html.twig', $arr);
		return $response;
    }


}