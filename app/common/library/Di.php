<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/1/2
 * Time: 上午10:42
 */

namespace Common\library;


class Di
{

    private static $di = [];

    private $contains = [];

    private function __construct()
    {
    }

    public static function getContain($name = 'default'){
        if(!isset(self::$di[$name])){
            self::$di[$name] = new self();
        }
        return self::$di[$name];
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }

    public function set($name,$value){

    }

    public function setShared($name,$value){

    }

    public function get($name){

    }

}