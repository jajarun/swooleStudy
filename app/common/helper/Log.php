<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/12/25
 * Time: 下午2:28
 */

namespace Common\Helper;


class Log
{

    private $filePath = '/tmp/debug.log';

    public static function debug($msg){
        echo $msg.PHP_EOL;
    }
}