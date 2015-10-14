<?php

namespace FrontEnd\FrontOfficeBundle\Controller;

use FrontEnd\FrontOfficeBundle\Entity\Task_Priority;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        
        $tasks = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Task')
            ->findLastTaskToDo(10);
            
        $priorities = array(
            Task_Priority::HIGH => 'label-danger',
            Task_Priority::MEDIUM => 'label-warning',
            Task_Priority::LOW => 'label-success',
        );
            
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
        
        return $this->render('FrontEndFrontOfficeBundle:Index:index.html.twig', array(
            'tasks' => $tasks, 
            'priorities' => $priorities, 
            'projects' => $projects
        ));
    }
}
