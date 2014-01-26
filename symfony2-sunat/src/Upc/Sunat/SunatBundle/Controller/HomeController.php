<?php

namespace Upc\Sunat\SunatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of HomeController
 *
 * @author herald olivares
 */
class HomeController extends Controller {

    /**
     * @Route("/", name="home_index")
     * @Template("SunatBundle:Sunat:index.html.twig")
     */
    public function indexAction(Request $request) {
        $form = $this->createForm('debt_search');
        $form->handleRequest($request);
        $em = $this->getDoctrine()
                ->getRepository('SunatBundle:Debt');
        $query = array();
        $ruc = null;
        $querystring = $request->query->get('debt_search');
        if ($querystring) {
            if (array_key_exists('ruc', $querystring)) {
                $ruc = $request->query->get('debt_search')['ruc'];
            }
        }
        //echo print_r($request->query);
        //echo $form;
        if ($ruc) {
            $query = $em->findByRuc($ruc);
        }
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 5/* limit per page */
        );
        return array(
            'pagination' => $pagination,
            'form' => $form->createView()
        );
    }

}