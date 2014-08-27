<?php
namespace Arcana\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;


class BaseController extends Controller
{
    public function baseListAction($type)
    {
        $items = $this->getDoctrine()
            ->getRepository('ArcanaBugtrackerBundle:' . $type)
            ->findAll();
        $path = strtolower($type) . 's_edit';
        foreach ($items as $item) {
            $url = $this->generateUrl(
                $path,
                array('id' => $item->getId())
            );
            $item->setUrl($url);
            // 
        }
        $url = $this->generateUrl(strtolower($type) . 's_add');
        $params = array(
            "items" => $items,
            "type" => $type,
            "addUrl" => $url
        );
        $response = $this->render('ArcanaBugtrackerBundle:' . $type . 's:list.html.twig', $params);
        return $response;
    }

    public function baseAddAction($entity, $id = false, Request $request, $type)
    {
        if ($type == "add") {
            $objectType = "Arcana\\BugtrackerBundle\\Entity\\" . $entity;
            $object = new $objectType();
        } elseif ($type == "edit") {
            $object = $this->getDoctrine()
                ->getRepository('ArcanaBugtrackerBundle:' . $entity)
                ->findOneById($id);
        }

        if ($object) {
            $formType = "Arcana\\BugtrackerBundle\\Form\\Type\\" . $entity . "Type";
            $form = $this->createForm(new $formType(), $object);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                try {
                    // item added
                    $em->persist($object);
                    $em->flush();
                    $response = $this->redirect($this->generateUrl(strtolower($entity) . 's_list'));
                } catch (\Doctrine\DBAL\DBALException $e) {
                    // item was not added, since duplicated title
                    $form->get('title')->addError(
                        new FormError('Please, provide unique title and fields should not be empty!')
                    );

                    $params = array(
                        'form' => $form->createView(),
                        'type' => $type,
                        'entity' => $entity
                    );
                    $response = $this->render('ArcanaBugtrackerBundle::add.html.twig', $params);
                }
                return $response;
            }

            // response if validation errors
            $params = array(
                'form' => $form->createView(),
                'type' => $type,
                'entity' => $entity
            );
            $response = $this->render('ArcanaBugtrackerBundle::add.html.twig', $params);
        } else {
            // response if no such id
            $params = array('message' => $entity . " with such id doesn't exist");
            $response = $this->render('ArcanaBugtrackerBundle:Errors:error.html.twig', $params);
        }
        return $response;
    }


}