<?php

spl_autoload_register('autoload_classes');

function autoload_classes($class){
    $valid_namespace = array('wpsujan');
    $class_segments = explode('\\', $class);
    if(in_array($class_segments[0], $valid_namespace)){
      include_once 'classes/'.join('/',$class_segments).".php";
    }
}

include_once 'vendor/autoload.php';

