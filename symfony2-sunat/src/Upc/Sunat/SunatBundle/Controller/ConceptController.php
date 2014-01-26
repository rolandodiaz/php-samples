<?php

namespace Upc\Sunat\SunatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Upc\Sunat\SunatBundle\Entity\Concept;
/**
 * Description of ConceptController
 *
 * @author herald olivares
 */
class ConceptController extends Controller {
    
    /**
     * @Route("/", name="concept_list")
     * @Template("")
     */
    public function listAction(){
        $em = $this->getDoctrine()
                ->getRepository('SunatBundle:Concept');
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
     * @Route("/add", name="concept_add")
     * @Template("")
     */
    public function newAction(Request $request) {
        $object = new Concept();
        $form = $this->createForm('concept', $object);
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'concept',
            'Registro grabado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'concept_add' : 'concept_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    /**
     * @Route("/{pk}", name="concept_edit")
     * @Template("")
     */
    public function editAction(Request $request, $pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Concept')->find($pk);
        if (!$object) {
            $this->createNotFoundException('No existe el concepto');
        }
        $form = $this->createForm('concept', $object);
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'concept',
            'Registro modificado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'concept_add' : 'concept_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/delete/{pk}", name="concept_delete")
     * @Template("")
     */
    public function deleteAction($pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Concept')->find($pk);        
        if (!$object) {
            $this->createNotFoundException('No existe el concepto');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
        'concept',
        'Registro eliminado satisfactoriamente'
        );
        $nextAction = 'concept_list';
        return $this->redirect($this->generateUrl($nextAction));
    }
    
}