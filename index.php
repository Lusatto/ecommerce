<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {
    	
    	$page = new Page();// chama o CONSTRUCT

    	$page->setTpl("index"); //chama o INDEX

});

$app->get('/admin', function() {
        
        $page = new PageAdmin();// chama o CONSTRUCT

        $page->setTpl("index"); //chama o INDEX

});

$app->run(); // faz rodar

 ?>