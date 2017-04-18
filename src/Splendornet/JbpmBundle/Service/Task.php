<?php

namespace Splendornet\JbpmBundle\Service;

use Exception;

/**
  * Task class to represent JBPM Task
  *
  * The class is used to create Task objects. We can call rest actions on Task objects such
  * as release, start and stop
  *      
  * @author  Mangesh Lad <m.lad@splendornet.com>
  *
  * @since 1.0     
  */
class Task
{          
    private static $_jbpm_rest_client;

    /**
      * Cunstructor function for Task. Creates task object from array of properties.
      * Array is in the format returned from jbpm rest API 
      *
      * @param JbpmRestClient $jbpm_rest_client  This is rest client service auto injected from DI.
      * @param array $jbpmTaskArray This is task array received from JBPM task/query endpoint.
      *
      *
      */
    public function __construct($jbpm_rest_client, $jbpmTaskArray=[])
    {        
        self::$_jbpm_rest_client = $jbpm_rest_client;

        //create Task object from jbpm task array
        if($jbpmTaskArray) {
            foreach($jbpmTaskArray as $property => $value) {        
                $this->{$property} = $value;
            }
        }                
    }          

    /**
      * This function gets the list of tasks from JBPM Rest API and creates Task objects.
      * Array of Task object is returned.
      *
      * @return Task $taskArray  Array of Task objects      
      */
    public static function getTasks() 
    {
        $client = self::$_jbpm_rest_client->getClient();
        $response = $client->get('task/query/');
        $data = $response->getBody()->getContents();        
        $data = json_decode($data,true);

        foreach($data['taskSummaryList'] as $task) {        
            $taskArray[] = new Task(self::$_jbpm_rest_client,$task);
        }

        return $taskArray;
    }
    
    /**
      * This function performs task release operation.      
      *
      * @return StdClass $result status object with status of operation
      */
    public function release()
    {
        $client = self::$_jbpm_rest_client->getClient();
        $response = $client->post('task/'.$this->id.'/release');

        return $response->getBody()->getContents();
    } 

    /**
      * This function performs task start operation.      
      *
      * @return StdClass $result status object with status of operation
      */
    public function start()
    {
        $client = self::$_jbpm_rest_client->getClient();
        $response = $client->post('task/'.$this->id.'/start');

        return $response->getBody()->getContents();
    }

    /**
      * This function performs task stop operation.      
      *
      * @return StdClass $result status object with status of operation
      */
    public function stop()
    {
        $client = self::$_jbpm_rest_client->getClient();
        $response = $client->post('task/'.$this->id.'/stop');

        return $response->getBody()->getContents();
    }        
}

