<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    	
    	$page = new Page();// chama o CONSTRUCT

    	$page->setTpl("index"); //chama o INDEX

});

$app->run(); // faz rodar

 ?>