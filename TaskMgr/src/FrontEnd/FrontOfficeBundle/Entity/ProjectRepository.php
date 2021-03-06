<?php

namespace FrontEnd\FrontOfficeBundle\Entity;

use FrontEnd\FrontOfficeBundle\Entity\Task_State;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    public function findProjectsAndState()
    {
        $projects = $this->findAll();
        $tasks = $this->getEntityManager()
        ->getRepository('FrontEndFrontOfficeBundle:Task')
        ->getAllTasks();
        
        $res = array();
        foreach($projects as $k=>$v)
        {
            $res[$v->getId()] = array(
                'infos' => $v,
                'tasksDone' => array(),
                'tasksTodo' => array(),
                'tasks' => array(),
                'progress' => 0
            );
        }
        
        $stats = array();
        foreach($tasks as $k=>$v)
        {
            $id = $v['proj_id'];
            
            if($v["state_id"] == Task_State::CANCELLED || $v["state_id"] == Task_State::DONE)
            {
                $res[$id]['tasksDone'][] = $v;   
            }
            else
            {
                $res[$id]['tasksTodo'][] = $v;   
            }
            
            if(!array_key_exists($id, $stats))
            {
                $stats[$id] = array(
                    'total' => 0,
                    'closed' => 0
                );
            }
            $res[$id]['tasks'][] = $v;   
            
            if($v["state_id"] == Task_State::CANCELLED || $v["state_id"] == Task_State::DONE)
            {
                $stats[$id]['closed'] += 1;
            }
            $stats[$id]['total'] += 1;
        }
        
        foreach($stats as $k=>$v)
        {
            if($v['total'] != 0)
            {
                $percent = round($v['closed'] / $v['total'] * 100);
            }
            else
            {
                $percent = 0;
            }
            $res[$k]['progress'] = $percent;
        }
        return $res;
    }
}
