<?php

namespace Splendornet\JbpmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Splendornet\JbpmBundle\Jbpm\Auth;
use Splendornet\JbpmBundle\Jbpm\Task;


class DefaultController extends Controller
{
    public function indexAction()
    { 
        // get JBPM client service to connect to rest API      
        $jbpmClient = $this->container->get('jbpm_rest_client')->getClient();

        // get all JBPM tasks
        $jbpmTasks = $this->container->get('jbpm_task')->getTasks();

        // echo "<pre>";
        // print_r($jbpmTasks);
        // echo "</pre>";exit;

        // get JBPM process by deployementId and processDefId

        $deploymentId = 'mortgages:mortgages:0.0.1';
        $processDefId = 'mortgages.HelloWorldProcess';
        $process = $this->container->get('jbpm_process')->getProcess($deploymentId,$processDefId);        
        
        // start process
        // $response = $process->start();
        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";exit;

        // stop process
        $response = $process->stop();
        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";exit;

        // release JBPM task
        $response = $jbpmTasks[1]->release();

        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";exit;

        // run JBPM task
        // $response = $jbpmTasks[1]->start();

        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";


        // stop JBPM running task\
        // $response = $jbpmTasks[1]->stop();

        // echo "<pre>";
        // print_r($response);
        // echo "</pre>";    
                
        exit;

        return $this->render('SplendornetJbpmBundle:Default:index.html.twig');
    }
}

