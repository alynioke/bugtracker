<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;


class BaseController extends Controller
{
    public function baseListAction($type)
    {
        $elements = $this->getDoctrine()
        ->getRepository('ArcanaBugtrackerBundle:'.$type)
        ->findAll();
        $params = array( "items" => $elements);
        $response = $this->render('ArcanaBugtrackerBundle:'.$type.'s:list.html.twig', $params);
        return $response;
    }
    
    public function baseAddAction($entity, $id = false, Request $request, $type)
    {
        if ($type == "add") {
            $objectType = "Arcana\\BugtrackerBundle\\Entity\\".$entity;
            $object = new $objectType();
        } elseif ($type == "edit") {     
            $object = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:'.$entity)
            ->findOneById($id);
        }
        
        if ($object) {
            $formType = "Arcana\\BugtrackerBundle\\Form\\Type\\".$entity."Type";
            $form = $this->createForm(new $formType(), $object);
            $form->handleRequest($request);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                try {
                    $em->persist($object);
                    $em->flush();
                } catch (\Doctrine\DBAL\DBALException $e) {
                    $form->get('title')->addError(new FormError('There is '.strtolower($entity).' with such title already! Choose different one.'));

                    $params = array('form' => $form->createView());
                    return $response = $this->render('ArcanaBugtrackerBundle:Users:add.html.twig', $params);
                }
                return $this->redirect($this->generateUrl(strtolower($entity).'s_list'));
            }

            $params = array('form' => $form->createView());
            $response = $this->render('ArcanaBugtrackerBundle:'.$entity.'s:add.html.twig', $params);
        } else {
            $params = array('message' => $entity." with such id doesn't exist");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:error.html.twig', $params);
        }
        return $response;
    }


}