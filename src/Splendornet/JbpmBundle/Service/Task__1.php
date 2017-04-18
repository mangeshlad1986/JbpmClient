<?php

namespace Splendornet\JbpmBundle\Jbpm;

use GuzzleHttp\Client;
use Exception;
use Splendornet\JbpmBundle\Jbpm\Auth;

class Task
{
    /**
     * class constructor
     * 
     * 
     */

    private $_id;    

    public function __construct($)
    {        
        //create Task object from jbpm task json
        foreach($jbpmTaskArray as $property => $value) {        
            $this->{$property} = $value;
        }        
    }          

    public static function getTasks() 
    {
        $client = Auth::getClient();
        $response = $client->get('task/query/');
        $data = json_decode($data,true);

        foreach($data['taskSummaryList'] as $task) {        
            $taskArray[] = new Task($task);
        }

        return $taskArray;
    }
    
    public function start()
    {
        $client = Auth::getClient();
        $response = $client->post('task/'.$taskId.'/execute');
    }

    public function stop()
    {
        $client = Auth::getClient();
        $response = $client->post('task/'.$taskId.'/stop');
    }     
}

