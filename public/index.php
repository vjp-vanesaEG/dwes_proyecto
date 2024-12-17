<?php

require_once '../utils/bootstrap.php';
require_once '../utils/utils.php';

use proyecto\entities\App;
use proyecto\entities\Request;

try{
    require App::get('router')->direct(Request::Uri(), $_SERVER['REQUEST_METHOD']);

}catch(Exception $e){
    die($e->getMessage());
}

?>