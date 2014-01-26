<?php

namespace Upc\Sunat\SunatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Upc\Sunat\SunatBundle\Entity\Debt;

/**
 * Description of DebtController
 *
 * @author herald olivares
 */
class DebtController extends Controller {
    
    /**
     * @Route("/", name="debt_list")
     * @Template("")
     */
    public function listAction(){
        $em = $this->getDoctrine()
                ->getRepository('SunatBundle:Debt');
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
     * @Route("/add", name="debt_add")
     * @Template("")
     */
    public function newAction(Request $request) {
        $object = new Debt();
        $form = $this->createForm('debt', $object);
        $form->handleRequest($request);

        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'debt',
            'Registro grabado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'debt_add' : 'debt_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    /**
     * @Route("/{pk}", name="debt_edit")
     * @Template("")
     */
    public function editAction(Request $request, $pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Debt')->find($pk);
        if (!$object) {
            $this->createNotFoundException('No existe la multa');
        }
        $form = $this->createForm('debt', $object);
        $form->handleRequest($request);
        if ($form->isValid()) {            
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
            'debt',
            'Registro modificado satisfactoriamente'
            );
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'debt_add' : 'debt_list';
            return $this->redirect($this->generateUrl($nextAction));
        }
        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/delete/{pk}", name="debt_delete")
     * @Template("")
     */
    public function deleteAction($pk) {
        $object = $this->getDoctrine()->getRepository('SunatBundle:Debt')->find($pk);        
        if (!$object) {
            $this->createNotFoundException('No existe la multa');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
        'debt',
        'Registro eliminado satisfactoriamente'
        );
        $nextAction = 'debt_list';
        return $this->redirect($this->generateUrl($nextAction));
    }
    
}