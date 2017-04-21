<?php

namespace Splendornet\JbpmBundle\Service;

use Exception;

/**
 * Process class to represent JBPM Process
 *
 * The class is used to create Process objects. We can call rest actions on Process objects such
 * as release, start and stop
 *      
 * @author  Mangesh Lad <m.lad@splendornet.com>
 *
 * @since 1.0     
 */
class Process
{
    private static $_jbpm_rest_client;
    public $deploymentId;
    public $processDefId;

    /**
     * Cunstructor function for Process. Creates Process object from array of properties.
     * Array is in the format returned from jbpm rest API 
     *
     * @param JbpmRestClient $jbpm_rest_client  This is rest client service auto injected from DI.
     * @param array $jbpmProcessArray This is Process array received from JBPM Process/query endpoint.
     *     
     */
    public function __construct($jbpm_rest_client,$deploymentId = NULL,$processDefId=NULL)
    {
        $this->deploymentId = $deploymentId;
        $this->processDefId = $processDefId;
        self::$_jbpm_rest_client = $jbpm_rest_client;
    }
    
    /**
     * This function performs Process start operation.      
     *
     * @return StdClass $result status object with status of operation
     */
    public function start()
    {                
        $client = self::$_jbpm_rest_client->getClient();
        try {            
            $response = $client->post('runtime/'.$this->deploymentId.'/process/'.$this->processDefId.'/start');
        }
        catch (Exception $e) {
            echo "Error occured while connecting to JBPM REST Api.";
            die;
        }
        
        return $response->getBody()->getContents();
    }
    
    /**
     * This function performs Process stop operation.      
     *
     * @return StdClass $result status object with status of operation
     */
    public function stop()
    {
        $client = self::$_jbpm_rest_client->getClient();
        try {            
            $response = $client->post('runtime/'.$this->deploymentId.'/process/'.$this->processDefId.'/stop');
        }
        catch (Exception $e) {
            echo "Error occured while connecting to JBPM REST Api.";
            die;
        }
        
        return $response->getBody()->getContents();
    }

    public function getProcess($deploymentId,$processDefId)
    {
        return new Process(self::$_jbpm_rest_client,$deploymentId,$processDefId);
    }
}
