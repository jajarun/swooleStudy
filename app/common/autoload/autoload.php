<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午4:54
 */

function autoloadNamespaceClass($name){
    $classPaths = explode('\\',$name);
    $className = array_pop($classPaths);
    $classPath = APP_PATH;
    foreach ($classPaths as $path){
        $classPath .= '/'.strtolower($path);
    }
    $classPath .= '/'.$className.'.php';
    if(!file_exists($classPath)){
        throw new Exception("$classPath not exist");
    }
    require $classPath;
}

spl_autoload_register('autoloadNamespaceClass');