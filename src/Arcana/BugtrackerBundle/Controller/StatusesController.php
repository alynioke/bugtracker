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

    /**
     * @Template()
     */

    public function listAction()
    {

        return array("name" => "st");

    }


}