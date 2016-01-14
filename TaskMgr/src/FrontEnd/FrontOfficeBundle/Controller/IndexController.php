<?php

namespace FrontEnd\FrontOfficeBundle\Controller;

use FrontEnd\FrontOfficeBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $securityContext = $this->container->get('security.context');
        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') || $securityContext->isGranted('IS_AUTHENTICATED_FULLY')){
            return $this->redirect($this->generateUrl('projets-index'));
        }
        
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('FrontEndFrontOfficeBundle:Index:index.html.twig', array(
            "error" => $error,
            "last_username" => $lastUsername
        ));
    }
    
    public function loginCheckAction()
    {}
    
    public function logout()
    {}
}
