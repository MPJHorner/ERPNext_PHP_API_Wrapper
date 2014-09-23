<?php

/**
* ERPNext RESTful API PHP Curl Library
*/

class erpnext{

  public $url;
  public $endpoint;
  public $endpoints-available = array(
                                      'method/login',
                                      'resource/Person',
                                      );
  public $method;
  public $username;
  public $password;

  /**
  * Constructs the class, requires an API url.
  */
  public function __construct($url){
    if(isset($url) && !empty($url)){
      $this->url = $url;
    }else{
      throw new Exception("URL not set.");
    }
  }

  /**
  * Connects to API url.
  */
  public function connect(){
    if(!isset($this->method)){
      throw new Exception("Method not set.");
    }
    $url = $this->url . '/api/' . $this->endpoint;
    $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',
    );

    $data_arr = array('some' => 'data',
                      'more' => 'data',
                      'data' => 'extra');
    $data = json_encode($data_arr);

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

    switch($this->method){
      case 'GET':
        break;
      case 'POST':
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        break;
      case 'PUT':
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        break;
      case 'DELETE':
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
        break;
    }
    $this->response->data = curl_exec($handle);
    $this->response->code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  }

  /**
  * Creates a record for the given resource.
  */
  public function create(){

  }

  /**
  * Reads a record for the given resource.
  */
  public function read(){
    $this->checkEndpoint();
    $this->method = 'GET';

  }

  /**
  * Updates a record for the given resource.
  */
  public function update(){

  }

  /**
  * Deletes a record for the given resource.
  */
  public function delete(){

  }

  /**
  * Login Request
  */
  public function login(){
    //Check Username and Password is set.
    if(!isset($this->username) || !isset($this->password)){
      throw new Exception("Username/Password not configured.");
    }else{
      $this->endpoint = 'method/login';
    }
  }
  private function checkEndpoint(){
    //Check Endpoint is set and exist in available endpoints
    if(!isset($this->endpoint) || !in_array($this->endpoint, $this->endpoints-available)){
      throw new Exception("Endpoint not available/not set.");
    }else{
      return true;
    }
  }
  public function debug(){
    if(!isset($this->reponse)){
      throw new Exception("Cannot dump data, no data set.");
    }else{
      echo '<h1>Debug</h1>';
      echo '<div>';
      echo '<h3>Raw Data</h3>';
      echo '<pre>';
      print_r($this);
      echo '</pre>';
      echo '</div>';
    }
  }
}








==========================================================================================================================================
==========================================================================================================================================
==========================================================================================================================================
==========================================================================================================================================
==========================================================================================================================================
==========================================================================================================================================
/**
* CRUD Methods
** Create (Post)
** Read (Get)
** Update (Put)
** Delete (Delete)
*/

$url = 'https://www.google.com';
$method = 'POST';

# headers and data (this is API dependent, some uses XML)
$headers = array(
'Accept: application/json',
'Content-Type: application/json',
);
$data = json_encode(array(
'firstName'=> 'John',
'lastName'=> 'Doe'
));

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

switch($method)
{

case 'GET':
break;

case 'POST':
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
break;

case 'PUT':
curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
break;

case 'DELETE':
curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
break;
}

$response = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
