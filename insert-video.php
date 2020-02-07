<?php

/**
 * Create a token for non-safe REST calls.
 **/
function mymodule_get_csrf_header() {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://dev.eluniversal.com.mx/euvideo_api/user/token.json");
  curl_setopt($ch, CURLOPT_POST, 1);
  //curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
  //curl_setopt_array($ch, array(
    //CURLOPT_RETURNTRANSFER => 1,
    ////CURLOPT_URL => 'http://drupal-7-69.dd:8083/api_web_v1/token.json',
    //CURLOPT_URL => 'https://dev.eluniversal.com.mx/euvideo_api/user/token.json',
  //));
  // Receive server response ...
  //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $csrf_token = curl_exec($ch);
  $arrayDataRequest = json_decode($csrf_token, true);
  curl_close($ch);

  //print 'X-CSRF-Token: ' . $arrayDataRequest["token"] . " \n";

  return 'X-CSRF-Token: ' . $arrayDataRequest["token"]; //. " \n";

}



//print mymodule_get_csrf_header();
/*
 * Server REST - user.login
 */

// REST Server URL
$request_url = 'https://dev.eluniversal.com.mx/euvideo_api/user/login.json';

// User data
$user_data = array(
  'username' => 'euvideo',
  'password' => 'EuVideo2020?s',
);
//$user_data = http_build_query($user_data);

$xCSRFToken = mymodule_get_csrf_header();

// cURL
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Accept JSON response
curl_setopt($curl, CURLOPT_HTTPHEADER, array( $xCSRFToken )); // Accept JSON response
curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
curl_setopt($curl, CURLOPT_POSTFIELDS, $user_data); // Set POST data
curl_setopt($curl, CURLOPT_HEADER, FALSE);  // Ask to not return Header
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

print " http_code: " . $http_code . "\n";

// Check if login was successful
if ($http_code == 200) {
   print " ==200 code \n";
   //Convert json response as array
   print_r($response);
   $logged_user = json_decode($response, true);
   print_r($logged_user);

   print " sessid: " . $logged_user["sessid"] . "\n";
   print " sessid: " . $logged_user->sessid . "\n";

   print " session_name: " .$logged_user["session_name"]. "\n";
   print " session_name: " .$logged_user->session_name. "\n";

   print " token: " .$logged_user["token"]. "\n";
   print " token: " .$logged_user->token. "\n";


}else{
  // Get error msg
  print " !=200 code \n";
  $http_message = curl_error($curl);
  print($http_message);
}


/*
 * Server REST - node.create
 */

// REST Server URL
$request_url = 'https://dev.eluniversal.com.mx/euvideo_api/node';

// Node data
//{
//  "type":"video",
//  "action":"create",
//  "title":"titulo de prueba video",
//  "field_titulo_abreviado":"titulo de prueba video",
//  "field_titulo_seo":[{"value":"titulo seo de prueba video"}],
//  "field_seccion":1,
//  "field_thumbnail":"https://i.ytimg.com/vi/KSbq8zFaIhU/mqdefault.jpg?sqp=CITL7vEF&rs=AOn4CLCGgoQgauGSEcEgLwW06SeczHxipQ",
//  "field_resumen":"Resumen",
//  "field_video":"Video",
//  "field_id_del_video":[{"value": "KSbq8zFaIhU","safe_value": "KSbq8zFaIhU","format" : "string"}],
//  "field_tags":"prueba,test"
//}

//$node_data = array(
//  'title' => 'A node created with services 3.x and REST server',
//  'type' => 'page',
//  'body[und][0][value]' => '<p>Body</p>',
//);

$node_data = array(
  'type' => 'video',
  'action' => 'create',
  'title' => 'titulo de prueba video',
  'field_titulo_abreviado' => 'titulo de prueba video',
  'field_titulo_seo' => 'field_titulo_seo',
  'field_seccion' => 1,
  'field_thumbnail' => "https://i.ytimg.com/vi/KSbq8zFaIhU/mqdefault.jpg?sqp=CITL7vEF&rs=AOn4CLCGgoQgauGSEcEgLwW06SeczHxipQ",
  'field_resumen' => 'Resumen',
  'field_video' => 'Video',
  'field_id_del_video' => 'field_id_del_video',
  'field_tags' => 'prueba,test',
);



//$node_data = http_build_query($node_data);

// Define cookie session
$cookie_session = $logged_user["session_name"] . '=' . $logged_user["sessid"];

// cURL
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Accept JSON response
curl_setopt($curl, CURLOPT_HTTPHEADER, array( $xCSRFToken ) ); // Accept JSON response
curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
curl_setopt($curl, CURLOPT_POSTFIELDS, $node_data); // Set POST data
curl_setopt($curl, CURLOPT_HEADER, FALSE);  // Ask to not return Header
curl_setopt($curl, CURLOPT_COOKIE, $cookie_session); // use the previously saved session
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

// Check if login was successful
if ($http_code == 200) {
  // Convert json response as array
  $node = json_decode($response);
}else{
  // Get error msg
  $http_message = curl_error($curl);
  print($http_message);
}

print_r($node);
