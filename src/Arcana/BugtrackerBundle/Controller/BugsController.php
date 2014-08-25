<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Arcana\BugtrackerBundle\Entity\User;
use Arcana\BugtrackerBundle\Entity\Role;


class BugsController extends Controller
{

    /**
     * @Template()
     */

    public function listAction()
    {


        return array( "bugs" => array(
        	0 => array("title" => "test1", "project" => "pr1", "status" => "opened", "priority" => 4),
        	1 => array("title" => "test2", "project" => "pr2", "status" => "opened", "priority" => 8),
        	2 => array("title" => "test3", "project" => "pr3", "status" => "closed", "priority" => 2))
        	);

    }


    public function addAction()
    {
        return new Response("add bug");

    }


}