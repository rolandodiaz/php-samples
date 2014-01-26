<?php

namespace Upc\Sunat\SunatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Upc\Sunat\SunatBundle\Entity\Person;

/**
 * Description of PersonController
 *
 * @author herald olivares
 */
class PersonController extends Controller {
    
    /**
     * @Route("/", name="person_list")
     * @Template("")
     */
    public function listAction(){
        $em = $this->getDoctrine()
                ->getRepository('SunatBundle:Person');
        $query = $em->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 5/* limit per page */
        );
        return array(
            'pagination' => $pagination
        );
    }
    
     /**
     * @Route("/add", name="person_add")
     * @Template("")
     */
    public function newAction(Request $request) {
        $object = new Person();
        $form = $this->createForm('person', $object);
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'person',
            'Registro grabado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'person_add' : 'person_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    /**
     * @Route("/{pk}", name="person_edit")
     * @Template("")
     */
    public function editAction(Request $request, $pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Person')->find($pk);
        if (!$object) {
            $this->createNotFoundException('No existe la persona');
        }
        $form = $this->createForm('person', $object);
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'person',
            'Registro modificado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'person_add' : 'person_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/delete/{pk}", name="person_delete")
     * @Template("")
     */
    public function deleteAction($pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Person')->find($pk);        
        if (!$object) {
            $this->createNotFoundException('No existe la persona');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
        'person',
        'Registro eliminado satisfactoriamente'
        );
        $nextAction = 'person_list';
        return $this->redirect($this->generateUrl($nextAction));
    }
    
}