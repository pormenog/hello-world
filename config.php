 <?php
 session_start();
 $base_url= filter_var('http://d-monitordte.kcl.cl', FILTER_SANITIZE_URL);

 define('CLIENT_ID','920599601093-pvv2ulil4v1d9p92e212e2ggmbqag3k5.apps.googleusercontent.com');
 define('CLIENT_SECRET','JHBFQOdhdwhooiLZKk10mMuq');
 define('REDIRECT_URI','http://d-monitordte.kcl.cl/index.php');
 define('APPROVAL_PROMPT','auto');
 define('ACCESS_TYPE','online');

/*
Client ID: 
920599601093-pvv2ulil4v1d9p92e212e2ggmbqag3k5.apps.googleusercontent.com
Email address: 
920599601093-pvv2ulil4v1d9p92e212e2ggmbqag3k5@developer.gserviceaccount.com
Client secret: 
JHBFQOdhdwhooiLZKk10mMuq
Redirect URIs: http://d-monitordte.kcl.cl/index.php
JavaScript origins: http://d-monitordte.kcl.cl*/
 ?>