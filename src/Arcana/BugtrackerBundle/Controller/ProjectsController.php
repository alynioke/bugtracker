<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Controller\BaseController;

class ProjectsController extends BaseController
{
    public function listAction()
    {
        return $this->baseListAction("Project");
    }

    public function addAction($id = false, Request $request, $type)
    {
        return $this->baseAddAction("Project", $id, $request, $type);
    }
}