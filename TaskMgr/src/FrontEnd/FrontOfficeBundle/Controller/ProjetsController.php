<?php

namespace FrontEnd\FrontOfficeBundle\Controller;

use FrontEnd\FrontOfficeBundle\Entity\Project;
use FrontEnd\FrontOfficeBundle\Entity\Task_Priority;
use FrontEnd\FrontOfficeBundle\Entity\Task_State;
use FrontEnd\FrontOfficeBundle\Form\Type\ProjectType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProjetsController extends Controller
{
    private function getLabelsClassPriorities()
    {
        return array(
            Task_Priority::HIGH => 'label-danger',
            Task_Priority::MEDIUM => 'label-warning',
            Task_Priority::LOW => 'label-success',
        );
    }
    
    private function getLabelsClassStates()
    {
        return array(
            Task_State::TEST => 'label-info',
            Task_State::TODO => 'label-primary',
            Task_State::DONE => 'label-success',
            Task_State::CANCELLED => 'label-default'
        );
    }
    
    public function projetsAction()
    {
        $tasks = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Task')
            ->findLastTaskToDo(10);
            
        $priorities = $this->getLabelsClassPriorities();
            
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
        
        return $this->render('FrontEndFrontOfficeBundle:Projets:projets.html.twig', array(
            'tasks' => $tasks, 
            'priorities' => $priorities, 
            'projects' => $projects
        ));
    }
    
    public function detailsAction($id, $name)
    {
        $priorities = $this->getLabelsClassPriorities();
        
        $states = $this->getLabelsClassStates();
            
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
            
        $project = $projects[$id];
            
        return $this->render('FrontEndFrontOfficeBundle:Projets:projets-details.html.twig', array(
            'priorities' => $priorities, 
            'states' => $states,
            'project' => $project,
            'projects' => $projects
        ));
    }
    
    public function editAction($id, $name, Request $request)
    {
        $priorities = $this->getLabelsClassPriorities();
        
        $states = $this->getLabelsClassStates();
        
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
            
        $project_data = $projects[$id];
        $project = $project_data["infos"];
        
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('projets-edition', array("id"=>$id, "name"=>$name)),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
                
                return $this->redirect($this->generateUrl('projets-details', array(
                    "id" => $project->getId(),
                    "name" => $project->getName()
                )));
            }
        }
        
        return $this->render('FrontEndFrontOfficeBundle:Projets:projets-edit.html.twig', array(
            'priorities' => $priorities, 
            'states' => $states,
            'project' => $project_data,
            'projects' => $projects,
            'form' => $form->createView()
        ));
    }
    
    public function createAction(Request $request)
    {
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
        
        $project = new Project();
        
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('projets-creation'),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($project);
                $em->flush();
                
                return $this->redirect($this->generateUrl('projets-details', array(
                    "id" => $project->getId(),
                    "name" => $project->getName()
                )));
            }
        }
            
        return $this->render('FrontEndFrontOfficeBundle:Projets:projets-create.html.twig', array(
            'projects' => $projects,
            'form' => $form->createView()
        ));
    }
}
