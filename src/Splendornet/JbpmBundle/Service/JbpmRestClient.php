<?php

namespace Splendornet\JbpmBundle\Service;

use GuzzleHttp\Client;
use Exception;

/**
  * JbpmRestClient class to for connection with JBPM REST API
  *
  * The class is used to connect with JBPM REST API and get response.
  * Authentication information is taken from config file and saved into client for subsequent use.
  * GuzzleHttpClient is used for rest calls.
  *
  * @author  Mangesh Lad <m.lad@splendornet.com>
  *
  * @since 1.0     
  */  
class JbpmRestClient
{
    /**
     * holds the client instance.      
     */
    private static $_client;
   /**
    * holds api uri      
    */
    private $api;
    /**
    * api user name      
    */
    private $user;
    /**
    * api password
    */    
    private $password;
    
    /**
      * Cunstructor function for Task. Creates task object from array of properties.
      * Array is in the format returned from jbpm rest API 
      *
      * @param String $api  JBPM REST API URI
      * @param String $user  JBPM user
      * @param String $password  JBPM password
      *     
      * @return GuzzleHttpClient instance
      */    
    public function __construct($api,$user,$password)
    {        
        if (!isset($api)) {
            throw new Exception("jbpm_api_url is not defined in settings");
        }
        
        if (!isset($user)) {
            throw new Exception("jbpm_api_user is not defined in settings");
        }
        
        if (!isset($password)) {
            throw new Exception("jbpm_api_password is not defined in settings");
        }

        $verify = true;

        if (isset($config['defaults_verify']) && $config['defaults_verify'] === false) {
            $verify = false;
        }
                

        self::$_client = new Client([
            'base_uri' => $api,
            'auth' => [
                $user, 
                $password
            ],
            'headers' => [
                'Accept'=>'application/json'
            ],
            'connect_timeout' => '10.00',
            'timeout' => '30.00',
            'verify' => FALSE // hardcoded for now
        ]);

        return self::$_client;
    }

    /**
      * Returns the GuzzleHttpClient instance
      *          
      * @return GuzzleHttpClient self::$_client      
      */
    public function getClient()
    {
        return self::$_client;
    }
}