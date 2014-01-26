<?php

namespace Upc\Sunat\SunatBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Upc\Sunat\SunatBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of ConceptController
 *
 * @author herald olivares
 */
class SecuredController extends Controller
{    
    
    /**
     * @Route("/user/add", name="_add_user")
     * @Template()
     */
    public function adduserAction()
    {
        $factory = $this->get('security.encoder_factory');
        $user = new User();
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword('admin', $user->getSalt());
        $user->setPassword($password);
        $user->setFullName("Administrador");
        $user->setUsername("admin");
        $user->setEmail("example@example.com");
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response('Created user id '.$user->getId());
    }
    
    /**
     * @Route("/login", name="_admin_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }
    
    /**
     * @Route("/login_check", name="_admin_security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="_admin_logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }       
    
    /**
     * @Route("/", name="_admin")
     * @Template()
     */
    public function indexAction()
    {
        return array(
            'context' => 'algo',
        );
    }
}

