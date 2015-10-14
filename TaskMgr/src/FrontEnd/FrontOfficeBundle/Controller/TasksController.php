<?php

namespace FrontEnd\FrontOfficeBundle\Controller;

use FrontEnd\FrontOfficeBundle\Entity\Project;
use FrontEnd\FrontOfficeBundle\Entity\Task;
use FrontEnd\FrontOfficeBundle\Entity\Task_Priority;
use FrontEnd\FrontOfficeBundle\Entity\Task_State;
use FrontEnd\FrontOfficeBundle\Form\Type\TaskType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TasksController extends Controller
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
    
    public function createAction($project_id, $project_name, Request $request)
    {
        $projects = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Project')
            ->findProjectsAndState();
        
        $state = $this->getDoctrine()
            ->getRepository('FrontEndFrontOfficeBundle:Task_State')
            ->find(Task_State::TODO);
        
        $task = new Task();
        $project_data = $projects[$project_id];
        $task->setProject($project_data['infos']);
        $task->setState($state);
        $task->setAddedAt(new \DateTime);
        
        $form = $this->createForm(new TaskType(), $task, array(
            'action' => $this->generateUrl('tasks-creation', array("project_id" => $project_id, "project_name" => $project_name)),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();
                
                return $this->redirect($this->generateUrl('projets-details', array(
                    "id" => $project_id,
                    "name" => $project_name
                )));
            }
        }
            
        return $this->render('FrontEndFrontOfficeBundle:Taches:taches-create.html.twig', array(
            'projects' => $projects,
            'project_name' => $project_name,
            'project_id' => $project_id,
            'form' => $form->createView()
        ));
    }
}