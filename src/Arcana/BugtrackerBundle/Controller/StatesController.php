<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Arcana\BugtrackerBundle\Controller\BaseController;

class StatesController extends BaseController
{
    public function listAction()
    {
        return $this->baseListAction("State");
    }
    
    public function addAction($id = false, Request $request, $type)
    {
        return $this->baseAddAction("State", $id, $request, $type);
    }
}