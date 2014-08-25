<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Entity\Role;


class StatusesController extends Controller
{


    public function listAction()
    {
        $arr = array( "items" => array(
        	0 => array("id"=>1, "title" => "test1", "project" => "pr1", "status" => "opened", "priority" => 4),
        	1 => array("id"=>2, "title" => "test2", "project" => "pr2", "status" => "opened", "priority" => 8),
        	2 => array("id"=>3, "title" => "test3", "project" => "pr3", "status" => "closed", "priority" => 2))
        	);
		$response = $this->render('ArcanaBugtrackerBundle:Statuses:list.html.twig', $arr);
		return $response;
    }

    public function addAction()
    {

        $response = $this->render('ArcanaBugtrackerBundle:Statuses:add.html.twig', $arr);
        return $response;
    }

    public function editAction()
    {
        $arr = array( "items" => array(
        	0 => array("id"=>1, "title" => "test1", "project" => "pr1", "status" => "opened", "priority" => 4),
        	1 => array("id"=>2, "title" => "test2", "project" => "pr2", "status" => "opened", "priority" => 8),
        	2 => array("id"=>3, "title" => "test3", "project" => "pr3", "status" => "closed", "priority" => 2))
        	);
		$response = $this->render('ArcanaBugtrackerBundle:Statuses:list.html.twig', $arr);
		return $response;
    }


}