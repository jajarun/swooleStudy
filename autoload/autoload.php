<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午4:54
 */

function autoloadNamespaceClass($name){
    echo $name;
}

spl_autoload_register('autoloadNamespaceClass');